<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
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
    public function index(): Response
    {
        $ow = Owner::getAll('username = ?' ,[$this->app->getAuth()->getLoggedUserName()]);
       if(count($ow) >0) {
            $zvierata = Animal::getAll('owner_id = ?' ,[$ow[0]->getId()]);
            return $this->html($zvierata);
        }
        else
        {
           return $this->html();

       }
    }

    public function delete()
    {
        $id= $this->request()->getValue('id');
        $deleteAnimal= Animal::getOne($id);
        $ow = Owner::getAll('username = ?' ,[$this->app->getAuth()->getLoggedUserName()]);
        if(count($ow) >0 && $ow[0]->getId()==$deleteAnimal->getOwnerId()) {
            $deleteAnimal?->delete();
        }
        return $this->redirect("?c=animals");

    }

    public function store()
    {
        $id= $this->request()->getValue('id');
        $animal= ($id ? Animal::getOne($id) : new Animal());
        $animal->setName($this->request()->getValue('meno'));
        $animal->setDayOfBirth($this->request()->getValue('date'));
        $animal->setWeight($this->request()->getValue('weight'));
        $ow = Owner::getAll('username = ?' ,[$this->app->getAuth()->getLoggedUserName()]);
        $animal->setOwnerId($ow[0]->getId());
        $datum  = explode('-', $animal->getDayOfBirth());
        $rok =(int)date("Y");
        $numberN    = preg_match('@[0-9]@', $animal->getName());
        $specialCharsN = preg_match('@[^\w]@',$animal->getName());
        if($numberN || $specialCharsN || strlen($animal->getName()) > 15 || strlen($animal->getName()) < 3)
        {
            $animal->test = "Meno musi obsahovať iba písmená a dlžka mena može byt od 3-15";
            return $this->html($animal,'create');

        }

        else if (!checkdate($datum[1],$datum[2],$datum[0]) || $datum[0] < 1940 || $datum[0] >= ($rok) )
        {
            $animal->test="Nesprávny dátum,format je den-mesiac-rok, minimálny rok je 1940 a maximálny je o rok menej ako momentálny dátum!";
            return $this->html($animal,'create');

        }
        else if ($animal->getWeight() < 1 || $animal->getWeight() > 900 )
        {
            $animal->test="Nesprávna váha, váha musí  byť minimálne 1  a maximalne 900!";
            return $this->html($animal,'create');
        }
        $animal->save();
        return  $this->redirect("?c=animals");

    }

    public function create()
    {

        return $this->html(new Animal(),'create');
    }

    public function edit()
    {
        $id= $this->request()->getValue('id');
        $editAnimal = Animal::getOne($id);
        return $this->html($editAnimal,'create');
    }
}