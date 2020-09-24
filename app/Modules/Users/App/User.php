<?php
declare(strict_types=1);

namespace App\Modules\Users\App;

use App\Interfaces\App\IUser;
use App\DTO\UserCreateDTO;
use App\Interfaces\Services\IUserService;
use App\DTO\UserAuthDTO;

class User implements IUser
{
    private $service;

    public function __construct(IUserService $service)
    {
        $this->service = $service;
    }

    public function store(string $email, string $name, string $password): UserAuthDTO
    {
        return $this->service->create(new UserCreateDTO($email, $name, $password));
    }
}
