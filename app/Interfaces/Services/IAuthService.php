<?php


namespace App\Interfaces\Services;


use App\Interfaces\DAO\IAuthLoginDAO;

interface IAuthService
{
    /**
     * @param string $email
     * @param string $password
     * @return IAuthLoginDAO
     */
    public function login(string $email, string $password):IAuthLoginDAO;

    /**
     * @return int|null
     */
    public function getLoggedUserId():?int;
}
