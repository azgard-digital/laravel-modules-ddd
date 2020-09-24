<?php
declare(strict_types=1);

namespace App\Modules\Users\Services;

use App\DTO\AuthLoginDTO;
use App\Exceptions\StoreResourceFailedException;
use App\DTO\UserAuthDTO;
use App\DTO\UserCreateDTO;
use App\Modules\Users\Models\UserRepository;
use App\Interfaces\Services\IAuthService;

class UserAuthAggregator
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var IAuthService
     */
    private $authService;

    /**
     * UserAuthAggregator constructor.
     * @param UserRepository $userRepository
     * @param IAuthService $authService
     */
    public function __construct(UserRepository $userRepository, IAuthService $authService)
    {
        $this->userRepository = $userRepository;
        $this->authService = $authService;
    }

    /**
     * @param UserCreateDTO $dao
     * @return UserAuthDTO
     */
    public function createAndAuthorize(UserCreateDTO $dto): UserAuthDTO
    {
        if ($this->userRepository->create($dto)) {
            /**
             * @var AuthLoginDTO $authDto
             */
            $authDto = $this->authService->login($dto->getEmail(), $dto->getPassword());

            return new UserAuthDTO(
                $dto->getEmail(),
                $dto->getName(),
                $authDto->getToken(),
                $authDto->getExpire()
            );
        }

        throw new StoreResourceFailedException('User has not been saved!');
    }
}
