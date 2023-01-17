<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\ViewResponse;
use App\Models\Animal;
use App\Models\Owner;

class AnimalsController extends AControllerBase
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
            case "store":
            case "create":
            case "edit":
            case "delete":
                return $this->app->getAuth()->isLogged();
        }


        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): ViewResponse
    {
            return $this->html();
    }

    public  function animals() :JsonResponse
    {
        $ow = Owner::getAll('username = ?' ,[$this->app->getAuth()->getLoggedUserName()]);
        if(count($ow) >0) {
            $zvierata = Animal::getAll('owner_id = ?' ,[$ow[0]->getId()]);
            return $this->json($zvierata);
        }
        else
        {
            return $this->json(0);
        }
    }
    /** @return JsonResponse
     * @throws \Exception
     */

    public function delete() : JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id= $data->id;
        $deleteAnimal= Animal::getOne($id);
        $ow = Owner::getAll('username = ?' ,[$this->app->getAuth()->getLoggedUserName()]);
        if(count($ow) >0 && $ow[0]->getId()==$deleteAnimal->getOwnerId()) {
            $deleteAnimal->delete();
            return $this->json("Deleted");
        }
        return $this->json("Not deleted");

    }

     /** @return JsonResponse
     * @throws \Exception
     */
    public function store() : JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        $animal = ($id ? Animal::getOne($id) : new Animal());
        $animal->setName($data->meno);
        $animal->setDayOfBirth($data->birth);
        $animal->setWeight($data->weight);
        $ow = Owner::getAll('username = ?', [$this->app->getAuth()->getLoggedUserName()]);
        $animal->setOwnerId($ow[0]->getId());
        $datum = explode('-', $animal->getDayOfBirth());
        $rok = (int)date("Y");
        $numberN = preg_match('@[0-9]@', $animal->getName());
        $specialCharsN = preg_match('@[^\w]@', $animal->getName());
        $zvierata = Animal::getAll('owner_id = ?' ,[$ow[0]->getId()]);

        foreach ($zvierata as $zviera) {
            if ($zviera->getName() == $data->meno && $animal->getOwnerId() == $zviera->getOwnerId() && !$data->id) {
                $animal->test = "Zviera s  daným menom už existuje";
                return $this->json($animal);
            }
        }
        if ($numberN || $specialCharsN || strlen($animal->getName()) > 15 || strlen($animal->getName()) < 3)

        {
            return $this->json($animal);

        }
        else if (!checkdate($datum[1],$datum[2],$datum[0]) || $datum[0] < 1940 || $datum[0] >= ($rok) )
        {
            return $this->json($animal);

        }
        else if ($animal->getWeight() < 1 || $animal->getWeight() > 900 )
        {
            return $this->json($animal);
        }

        $animal->save();
        return $this->json("ok");

    }

    /** @return JsonResponse
     * @throws \Exception
     */
    public function edit() : JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id= $data->id;
        $editAnimal = Animal::getOne($id);
        $ow = Owner::getAll('username = ?' ,[$this->app->getAuth()->getLoggedUserName()]);
        if($editAnimal && count($ow) >0 && $ow[0]->getId()==$editAnimal->getOwnerId()) {
            return $this->json($editAnimal);
        }
        return $this->json("Something went wrong");
    }
}