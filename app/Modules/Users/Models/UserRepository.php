<?php


namespace App\Modules\Users\Models;


use App\Exceptions\StoreResourceFailedException;
use Illuminate\Support\Facades\Log;

abstract class UserRepository
{
    /**
     * @param string $email
     * @param string $name
     * @param string $password
     * @return bool|StoreResourceFailedException
     */
    public static function create(string $email, string $name, string $password):bool
    {
        try {
            $model = new User([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password)
            ]);

            return (bool)$model->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new StoreResourceFailedException('User has not been created!');
        }
    }
}
