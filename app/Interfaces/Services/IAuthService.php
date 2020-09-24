<?php
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTO\AuthLoginDTO;

interface IAuthService
{
    /**
     * @param string $email
     * @param string $password
     * @return AuthLoginDTO
     */
    public function login(string $email, string $password): AuthLoginDTO;

    /**
     * @return int|null
     */
    public function getLoggedUserId(): ?int;
}
