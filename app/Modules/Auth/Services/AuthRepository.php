<?php


namespace App\Modules\Auth\Services;


use App\Exceptions\AuthorizationException;
use App\Interfaces\DAO\IAuthLoginDAO;
use App\Modules\Auth\DAO\AuthLoginDAO;

class AuthRepository
{
    public function login(string $email, string $password):IAuthLoginDAO
    {
        if (!$token = auth()->attempt(['email' => $email, 'password' => $password])) {
            throw new AuthorizationException('Invalid email or password');
        }

        $expire = auth()->factory()->getTTL();

        return new AuthLoginDAO($token, $expire);
    }

    public function getLoggedUserId():?int
    {
        $user = auth()->user();

        if ($user) {
            return (int)$user->id;
        }

        return null;
    }
}
