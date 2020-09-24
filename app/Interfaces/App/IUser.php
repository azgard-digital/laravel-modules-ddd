<?php
declare(strict_types=1);

namespace App\Interfaces\App;

use App\DTO\UserAuthDTO;

interface IUser
{
    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return UserAuthDTO
     */
    public function store(string $email, string $name, string $password): UserAuthDTO;
}
