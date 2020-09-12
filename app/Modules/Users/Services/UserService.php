<?php


namespace App\Modules\Users\Services;

use App\Interfaces\DAO\IUserAuthDAO;
use App\Interfaces\DAO\IUserCreateDAO;
use App\Interfaces\Services\IUserService;

class UserService implements IUserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AuthRepository
     */
    private $authRepository;

    public function __construct(UserRepository $userRepository, AuthRepository $authRepository)
    {
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    public function create(IUserCreateDAO $dao):IUserAuthDAO
    {
        $aggregate = new UserAuthAggregator($this->userRepository, $this->authRepository);
        return $aggregate->createAndAuthorize($dao);
    }
}
