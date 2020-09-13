<?php


namespace App\Modules\Auth\App;


use App\Interfaces\App\IAuth;
use App\Interfaces\DAO\IAuthLoginDAO;
use App\Interfaces\Services\IAuthService;

class Auth implements IAuth
{
    private $service;

    public function __construct(IAuthService $service)
    {
        $this->service = $service;
    }

    public function login(string $email, string $password):IAuthLoginDAO
    {
        return $this->service->login($email, $password);
    }
}
