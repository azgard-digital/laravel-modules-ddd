<?php


namespace App\Modules\Users\Services;

use App\Exceptions\StoreResourceFailedException;
use App\Interfaces\DAO\IAuthLoginDAO;
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
        if ($this->userRepository->create($dao)) {
            /**
             * @var IAuthLoginDAO $authDao
             */
            $authDao = $this->authRepository->login($dao->getEmail(), $dao->getPassword());

            return new UserAuthDAO(
                $dao->getEmail(),
                $dao->getName(),
                $authDao->getToken(),
                $authDao->getExpire()
            );
        }

        throw new StoreResourceFailedException('User has not been saved!');
    }
}
