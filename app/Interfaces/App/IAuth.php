<?php
declare(strict_types=1);

namespace App\Interfaces\App;

use App\DTO\AuthLoginDTO;

interface IAuth
{
    public function login(string $email, string $password): AuthLoginDTO;
}
