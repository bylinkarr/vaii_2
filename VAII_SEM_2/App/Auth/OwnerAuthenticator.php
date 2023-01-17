<?php

namespace App\Auth;

use App\Models\Owner;

class OwnerAuthenticator extends DummyAuthenticator
{
    public function login($username, $password): bool
    {

        $prihlasenie= Owner::getAll("username = '$username'");
        if (count($prihlasenie) > 0) {
            if (password_verify($password, $prihlasenie[0]->getPassword())) {
                $_SESSION['user'] = $username;
                return true;
            }
        }
            return false;
    }
    public  function register($username): bool
    {
        $regististracia= Owner::getAll("username = '$username'");
        if (count($regististracia) > 0) {
                return false;
        }
        return true;
    }

    public function isAdmin(): bool
    {
        $ow =Owner::getOne($this->getLoggedUserId());
        if(isset($ow))
        return   $ow->getAdmin()==1;
        return false;
    }

    function getLoggedUserId(): mixed
    {
        $user =$_SESSION['user'];
        $ow =Owner::getAll("username = '$user'");
        if(count($ow)>0)
        {
            return $ow[0]->getId();
        }
        return 0;
    }
}