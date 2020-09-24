<?php
declare(strict_types=1);

namespace App\Modules\Auth\App;

use App\DTO\AuthLoginDTO;
use App\Interfaces\App\IAuth;
use App\Interfaces\Services\IAuthService;

class Auth implements IAuth
{
    private $service;

    public function __construct(IAuthService $service)
    {
        $this->service = $service;
    }

    public function login(string $email, string $password): AuthLoginDTO
    {
        return $this->service->login($email, $password);
    }
}
