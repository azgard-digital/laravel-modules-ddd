<?php


namespace App\Interfaces\App;


use App\Interfaces\DAO\IUserAuthDAO;

interface IUser
{
    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return IUserAuthDAO
     */
    public function create(string $email, string $name, string $password):IUserAuthDAO;
}
