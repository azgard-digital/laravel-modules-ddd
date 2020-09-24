<?php
declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Exceptions\AuthorizationException;
use App\DTO\AuthLoginDTO;
use Tymon\JWTAuth\JWTAuth;

class AuthRepository
{
    private $authManager;

    public function __construct(JWTAuth $authManager)
    {
        $this->authManager = $authManager;
    }

    public function login(string $email, string $password): AuthLoginDTO
    {
        if (!$this->authManager->attempt(['email' => $email, 'password' => $password])) {
            throw new AuthorizationException('Invalid email or password');
        }

        $token = $this->authManager->getToken()->get();
        $expire = (string)$this->authManager->factory()->getTTL();

        return new AuthLoginDTO($token, $expire);
    }

    public function getLoggedUserId(): ?int
    {
        $user = $this->authManager->user();

        if ($user) {
            return (int)$user->id;
        }

        return null;
    }
}
