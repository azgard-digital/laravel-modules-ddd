<?php


namespace App\Modules\Users\Services;

use App\Interfaces\DAO\IUserAuthDAO;
use App\Interfaces\DAO\IUserCreateDAO;
use App\Modules\Users\DAO\UserAuthDAO;

class UserAuthAggregator
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AuthRepository
     */
    private $authRepository;

    /**
     * UserAuthAggregator constructor.
     * @param UserRepository $userRepository
     * @param AuthRepository $authRepository
     */
    public function __construct(UserRepository $userRepository, AuthRepository $authRepository)
    {
        $this->userRepository = $userRepository;
        $this->authRepository = $authRepository;
    }

    /**
     * @param IUserCreateDAO $dao
     * @return IUserAuthDAO
     */
    public function createAndAuthorize(IUserCreateDAO $dao):IUserAuthDAO
    {

        return new UserAuthDAO();
    }
}
