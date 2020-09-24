<?php
declare(strict_types=1);

namespace App\Modules\Auth\Controllers\Api\V1;

use App\Modules\Auth\Controllers\Api\V1\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\App\IAuth;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    private $authApp;

    public function __construct(IAuth $authApp)
    {
        $this->authApp = $authApp;
    }

    public function login(LoginRequest $request): JsonResource
    {
        return new Resources\LoginResource(
            $this->authApp->login(
                $request->getEmail(),
                $request->getPassword()
            )
        );
    }
}

