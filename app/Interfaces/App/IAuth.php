<?php


namespace App\Interfaces\App;


use App\Interfaces\DAO\IAuthLoginDAO;

interface IAuth
{
    public function login(string $email, string $password):IAuthLoginDAO;
}
