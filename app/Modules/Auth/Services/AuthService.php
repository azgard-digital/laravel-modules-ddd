<?php


namespace App\Modules\Auth\Services;


use App\Interfaces\DAO\IAuthLoginDAO;
use App\Interfaces\Services\IAuthService;
use App\Modules\Auth\Services\AuthRepository;

class AuthService implements IAuthService
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(string $email, string $password):IAuthLoginDAO
    {
        return $this->authRepository->login($email, $password);
    }

    public function getLoggedUserId():?int
    {
        return $this->authRepository->getLoggedUserId();
    }
}
