<?php


namespace App\Modules\Users\Controllers\Api\V1;

use App\Modules\Users\Controllers\Api\V1\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\App\IUser;

class UsersController extends Controller
{
    private $user;

    public function __construct(IUser $user)
    {
        $this->user = $user;
    }

    public function store(RegisterRequest $request)
    {
        return new Responses\RegisterResponse(
            $this->user->create(
                $request->getEmail(),
                $request->getName(),
                $request->getPassword()
            )
        );
    }
}

