<?php
declare(strict_types=1);

namespace App\Modules\Users\Services;

use App\DTO\UserAuthDTO;
use App\DTO\UserCreateDTO;
use App\Interfaces\Services\IUserService;

class UserService implements IUserService
{
    private $userAuthAggregator;

    public function __construct(UserAuthAggregator $userAuthAggregator)
    {
        $this->userAuthAggregator = $userAuthAggregator;
    }

    public function create(UserCreateDTO $dto): UserAuthDTO
    {
        return $this->userAuthAggregator->createAndAuthorize($dto);
    }
}
