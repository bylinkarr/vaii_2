<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\JsonResponse;
use App\Core\Responses\Response;
use App\Models\Evaluation;
use App\Models\Owner;
use App\Models\Tournament;
use http\Client\Curl\User;

class EvaluationsController extends AControllerBase
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
    public function index(): Response
    {
        $matches = Tournament::getAll('date < ?',[date('Y-m-d')]);
        return $this->html($matches);
    }
    /** @return JsonResponse
     * @throws \Exception
     */
    public function hodnotenie(): JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id= $data->id;
        $e= Evaluation::getOne($id);
        return $this->json($e);

    }



    /** @return JsonResponse
     * @throws \Exception
     */
    public function hodnotenia() : JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $hodnotenia = Evaluation::getAll('id_match =?', [$data->selected]);
        if (count($hodnotenia)>0)
        {
            foreach ($hodnotenia as $hodnotenie)
            {
                $ow=Owner::getOne($hodnotenie->getUserId());
                $hodnotenie->setUsername($ow->getUsername());
                if ($hodnotenie->getUsername() == $this->app->getAuth()->getLoggedUserName())
                {
                    $hodnotenie->setJeVlastnik("Edit");
                } else
                {
                    $hodnotenie->setJeVlastnik("");
                }
            }
        }
            return $this->json($hodnotenia);
    }


    /** @return JsonResponse
     * @throws \Exception
     */
    public function addEvaluation() : JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        $hodnotenie = new Evaluation();
        if (!$data->title) {
            return $this->json($hodnotenie);
        }
        $hodnotenie->setTitle($data->title);

        if (!$data->comment) {
            return $this->json($hodnotenie);
        }
        $hodnotenie->setComment($data->comment);
        $hodnotenie->setStar($data->star);
        if ($data->selected == 0) {
            return $this->json($hodnotenie);
        }

        $hodnotenie->setIdMatch($data->selected);
        $hodnotenia = Evaluation::getAll('id_match =?', [$data->selected]);
        if ($id == "") {
            {
                if (count($hodnotenia) > 0) {
                    foreach ($hodnotenia as $one) {
                        if ($one->getUserId() == $this->app->getAuth()->getLoggedUserId()) {
                            return $this->json($hodnotenie);
                        }
                    }
                }
            }
                $hodnotenie->setDateCreated(date('Y-m-d'));
                $hodnotenie->setUserId($this->app->getAuth()->getLoggedUserId());
                 $hodnotenie->save();
                    return $this->json($hodnotenie);
            }
            else
            {
                $e = Evaluation::getOne($id);
                if (!isset($e) || $e->getUserId()!=$this->app->getAuth()->getLoggedUserId())
                {
                    return $this->json("Not yours!");
                }
                $hodnotenie->setIdMatch($e->getIdMatch());
                $hodnotenie->setDateCreated(date('Y-m-d'));
                $hodnotenie->setUserId($this->app->getAuth()->getLoggedUserId());
                $hodnotenie->setId($e->getId());
                $hodnotenie->save();
                return $this->json($hodnotenie);


            }

    }

    /** @return JsonResponse
     * @throws \Exception
     */

    public function delete() : JsonResponse
    {
        $data = json_decode(file_get_contents('php://input'));

        $id= $data->id;
        $deleteE= Evaluation::getOne($id);
        if(isset($deleteE) && $this->app->getAuth()->getLoggedUserId()==$deleteE->getUserId()) {
            $deleteE->delete();
            return $this->json("Deleted");
        }
        return $this->json("Not deleted");

    }

}
