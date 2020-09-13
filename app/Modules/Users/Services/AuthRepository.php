<?php


namespace App\Modules\Users\Services;


use App\Interfaces\DAO\IAuthLoginDAO;
use App\Interfaces\Services\IAuthService;

class AuthRepository
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