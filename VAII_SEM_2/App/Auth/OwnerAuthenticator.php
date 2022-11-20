<?php

namespace App\Auth;

use App\Models\Owner;

class OwnerAuthenticator extends DummyAuthenticator
{
    private bool $isA;
    public function login($username, $password): bool
    {

        $prihlasenie= Owner::getAll("username = '$username'");
        if (count($prihlasenie) > 0) {
            if (password_verify($password, $prihlasenie[0]->getPassword())) {
                $_SESSION['user'] = $username;
                if($prihlasenie[0]->getAdmin() == 1){
                    $this->isA=true;
                }
                else
                {
                    $this->isA=false;

                }
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
        return $this->isA;
    }
}