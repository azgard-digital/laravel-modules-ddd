<?php

namespace App\Modules\Auth\Controllers\Api\V1;

use App\Modules\Auth\Controllers\Api\V1\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\App\IAuth;

class AuthController extends Controller
{
    private $auth;

    public function __construct(IAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginRequest $request)
    {
        return new Responses\LoginResponse(
            $this->auth->login(
                $request->getEmail(),
                $request->getPassword()
            )
        );
    }
}

