<?php


namespace App\Modules\Users\App;


use App\Interfaces\App\IUser;
use App\Modules\Users\DAO\UserCreateDAO;
use App\Interfaces\DAO\IUserAuthDAO;
use App\Modules\Users\Interfaces\DAO\IUserDAO;
use App\Interfaces\Services\IUserService;

class User implements IUser
{
    private $service;

    public function __construct(IUserService $service)
    {
        $this->service = $service;
    }

    public function create(string $email, string $name, string $password):IUserAuthDAO
    {
        return $this->service->create(new UserCreateDAO($email, $name, $password));
    }
}
