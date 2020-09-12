<?php
namespace App\Modules\Users;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * Class UsersServiceProvider
 * @package App\Modules\Users
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class UsersServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot()
    {
        $request = request();

        /** register api v1 routes */
        if (app()->get('accept')->parseApiVersion($request) === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Users\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }
    }

    public function register()
    {
        $this->app->bind('App\Interfaces\Services\IUserService', 'App\Modules\Users\Services\UserService');
        $this->app->bind('App\Interfaces\App\IUser', 'App\Modules\Users\App\User');
    }

}
