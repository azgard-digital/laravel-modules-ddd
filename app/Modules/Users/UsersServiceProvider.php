<?php
declare(strict_types=1);

namespace App\Modules\Users;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Services\IUserService;
use App\Modules\Users\Services\UserService;
use App\Interfaces\App\IUser;
use App\Modules\Users\App\User;

/**
 * Class UsersServiceProvider
 * @package App\Modules\Users
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class UsersServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        /** register api v1 routes */
        if ($this->app->get('accept')->parseApiVersion() === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Users\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }
    }

    public function register()
    {
        $this->app->singleton(IUserService::class, UserService::class);
        $this->app->singleton(IUser::class, User::class);
    }
}
