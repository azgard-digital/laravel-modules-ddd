<?php
declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\DTO\AuthLoginDTO;
use App\Interfaces\Services\IAuthService;

class AuthService implements IAuthService
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(string $email, string $password): AuthLoginDTO
    {
        return $this->authRepository->login($email, $password);
    }

    public function getLoggedUserId(): ?int
    {
        return $this->authRepository->getLoggedUserId();
    }
}
