<?php

namespace App\Models;

use App\Core\Model;

class Animal extends Model
{
    protected $id;
    protected $owner_id;
    protected $name;
    protected $day_of_birth;
    protected $weight;
    public string $test=" ";



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param mixed $owner_id
     */
    public function setOwnerId($owner_id): void
    {
        $this->owner_id = $owner_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDayOfBirth()
    {
        return $this->day_of_birth;
    }

    /**
     * @param mixed $day_of_birth
     */
    public function setDayOfBirth($day_of_birth): void
    {
        $this->day_of_birth = $day_of_birth;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

}