<?php
declare(strict_types=1);

namespace App\Modules\Users\Models;

use App\Exceptions\StoreResourceFailedException;
use App\DTO\UserCreateDTO;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return bool|StoreResourceFailedException
     */
    public static function create(UserCreateDTO $dto): bool
    {
        try {
            $model = new User();

            $model->fill([
                'name' => $dto->getName(),
                'email' => $dto->getEmail(),
                'password' => bcrypt($dto->getPassword())
            ]);

            return $model->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new StoreResourceFailedException('User has not been created!');
        }
    }
}
