<?php


namespace App\Interfaces\Services;


use App\Interfaces\DAO\IAuthLoginDAO;

interface IAuthService
{
    public function login(string $email, string $password):IAuthLoginDAO;
}
