<?php
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTO\UserCreateDTO;
use App\DTO\UserAuthDTO;

interface IUserService
{
    /**
     * @param UserCreateDTO $dao
     * @return UserAuthDTO
     */
    public function create(UserCreateDTO $dao): UserAuthDTO;
}
