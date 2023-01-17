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

                $new_prize1 = new Winning();
                $new_prize2 = new Winning();
                $new_prize3 = new Winning();
                $new_match = Tournament::getAll('name=?', [$this->request()->getValue('title_konanie')]);
                $new_prize1->setPlacement(1);
                $new_prize2->setPlacement(2);
                $new_prize3->setPlacement(3);
                $new_prize1->setPrize($this->request()->getValue('vyhra1'));
                if ($new_prize1->getPrize() == NULL || $new_prize1->getPrize() == "" || !is_numeric($new_prize1->getPrize())) {
                    $data = ['message' => 'Pole výhry pre prvé miesto nemože byť prázdne!'];
                    return $this->html($data);

                }
                $new_prize2->setPrize($this->request()->getValue('vyhra2'));
                if ($new_prize2->getPrize() == NULL || $new_prize2->getPrize() == "" || !is_numeric($new_prize2->getPrize())) {
                    $data = ['message' => 'Pole výhry pre druhé miesto nemože byť prázdne!'];
                    return $this->html($data);

                }
                $new_prize3->setPrize($this->request()->getValue('vyhra3'));
                if ($new_prize3->getPrize() == NULL || $new_prize3->getPrize() == "" || !is_numeric($new_prize3->getPrize())) {
                    $data = ['message' => 'Pole výhry pre tretie miesto nemože byť prázdne!'];
                    return $this->html($data);

                }
                $new_prize1->setIdMatch($new_match[0]->getId());
                $new_prize2->setIdMatch($new_match[0]->getId());
                $new_prize3->setIdMatch($new_match[0]->getId());
                $new_prize1->save();
                $new_prize2->save();
                $new_prize3->save();

                return $this->redirect('?c=matches');
            }
        }
        $data =[];
        return $this->html($data);


    }

}