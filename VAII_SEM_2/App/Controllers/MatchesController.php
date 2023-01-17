<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Models\Animal;
use App\Models\Owner;
use App\Models\Tournament;
use App\Models\Winning;
use function Sodium\add;


class MatchesController extends  AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return $this->app->getAuth()->isLogged();
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */


    public  function matches() :JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));;
        $zapasy = Tournament::getAll('',[],'date');
        $vyt_zapasy = array();

        foreach ($zapasy as $zapas) {
                if (!strcmp((strtolower(substr($zapas->getName(), 0, strlen($data->vyhladaj)))),strtolower($data->vyhladaj))) {

                    if ($data->checked && date('Y-m-d') < $zapas->getDate()) {
                        $vyt_zapasy[] = $zapas;
                    } else if (!$data->checked)
                    {
                        $vyt_zapasy[] = $zapas;
                    }
                }

            }
        if (count($vyt_zapasy) > 0) {

            return $this->json($vyt_zapasy);

        }
         else
         {
             return $this->json($vyt_zapasy);
         }
    }

    public  function info() :JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id= $data->id;
        $info = Winning::getall('id_match = ?' ,[$id]);
       return  count($info)>0 ? $this->json($info) :  $this->json("Nothing");

    }
    public  function nameofanimal() :JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id= $data->id;
        $meno = Animal::getOne($id);

        return isset($meno) ? $this->json($meno->getName()) : $this->json("-");

    }

    public function index(): Response
    {
        return $this->html();
    }
    /**
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function create() : Response
    {
        if ($this->app->getAuth()->isAdmin()) {
            $formData = $this->app->getRequest()->getPost();
            if (isset($formData['submit'])) {
                $new_match = new Tournament();
                $new_match->setName($this->request()->getValue('title_konanie'));
                if (strlen($new_match->getName()) > 25 || strlen($new_match->getName()) < 3) {
                    $data = ['message' => 'Nadpis musi mať rozsah  od 3 po 25!'];
                    return $this->html($data);

                }
                $new_match->setCity($this->request()->getValue('city_konanie'));
                if ($new_match->getCity() == NULL || $new_match->getCity() == "") {
                    $data = ['message' => 'Pole s Mestom nemože byť prázdne!'];
                    return $this->html($data);
                }
                $new_match->setDate($this->request()->getValue('date_konanie'));
                $datum = explode('-', $new_match->getDate());
                if (!checkdate($datum[1], $datum[2], $datum[0]) || $datum[0] < 1940) {
                    $data = ['message' => 'Nesprávny dátum alebo zle zadaný rok(min 1941)!'];
                    return $this->html($data);
                }
                $new_match->save();

                return $this->redirect('?c=matches');
            }
        }
        $data =[];
        return $this->html($data);


    }

}