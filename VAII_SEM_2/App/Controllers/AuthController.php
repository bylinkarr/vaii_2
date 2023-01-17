<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Owner;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{

    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        switch ($action)
        {
            case "login":
            case "register":
             return !$this->app->getAuth()->isLogged();
        }

        return true;
    }

    /**
     *
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['username'], $formData['password']);
            if($logged && !$this->app->getAuth()->isAdmin())
            {
                return $this->redirect('?c=home');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }

    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->html();
    }

    public function register(): Response
    {

        $formData = $this->app->getRequest()->getPost();
        $registered = null;
        if (isset($formData['submit'])) {

            $user = new Owner();
            if(strlen($formData['username']) < 5 || strlen($formData['username']) > 15)
            {
                return $this->html(['message' => 'Username musí mať aspoň 5 znakov a maximálne 15']);
            }
            $user->setUsername($formData['username']);
            if($this->validateStr($formData['password']))
            {
                return $this->html(['message' => 'Heslo musí mat aspoň 8 znakov, jedno číslo
                jedno veľké písmeno a aspoň jeden špecialny znak']);
            }
            $user->setPassword(password_hash($formData['password'],PASSWORD_DEFAULT));
            if (isset($formData['first_name']))
            {
                $user->setFirstName($formData['first_name']);
            }
            if (isset($formData['last_name']))
            {
                $user->setLastName($formData['last_name']);
            }
            if (isset($formData['email']))
            {
                $user->setEmail($formData['email']);
            }
            if (isset($formData['city']))
            {
                $user->setCity($formData['city']);
            }
            $registered = $this->app->getAuth()->register($formData['username']);
            if ($registered) {;
                $user->save();
                 $this->app->getAuth()->login($formData['username'], $formData['password']);
                return $this->redirect('?c=home');
            }
        }

        $data = ($registered === false ? ['message' => 'Uživateľ s daným username už existuje!'] : []);
        return $this->html($data);
    }

     private function validateStr($str) : bool
    {
        $uppercase = preg_match('@[A-Z]@', $str);
        $lowercase = preg_match('@[a-z]@',$str);
        $number    = preg_match('@[0-9]@', $str);
        $specialChars = preg_match('@[^\w]@',$str);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($str) < 8 || strlen($str) > 25)
        {
            return true;
        }
        return false;
    }

}