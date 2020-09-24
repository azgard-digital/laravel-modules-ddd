<?php
declare(strict_types=1);

namespace App\Modules\Users\Controllers\Api\V1;

use App\Modules\Users\Controllers\Api\V1\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\App\IUser;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersController extends Controller
{
    private $userApp;

    public function __construct(IUser $userApp)
    {
        $this->userApp = $userApp;
    }

    public function store(RegisterRequest $request): JsonResource
    {
        return new Resources\RegisterResource(
            $this->userApp->store(
                $request->getEmail(),
                $request->getName(),
                $request->getPassword()
            )
        );
    }
}

