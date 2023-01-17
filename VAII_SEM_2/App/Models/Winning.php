<?php

namespace App\Models;

use App\Core\Model;

class Winning extends Model
{
    protected $id;
    protected $id_match;
    protected $prize;
    protected $id_zvierata;

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @param mixed $placement
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdMatch()
    {
        return $this->id_match;
    }

    /**
     * @param mixed $id_match
     */
    public function setIdMatch($id_match): void
    {
        $this->id_match = $id_match;
    }

    /**
     * @return mixed
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * @param mixed $prize
     */
    public function setPrize($prize): void
    {
        $this->prize = $prize;
    }

    /**
     * @return mixed
     */
    public function getIdZvierata()
    {
        return $this->id_zvierata;
    }

    /**
     * @param mixed $id_zvierata
     */
    public function setIdZvierata($id_zvierata): void
    {
        $this->id_zvierata = $id_zvierata;
    }



}