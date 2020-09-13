<?php
namespace App\Modules\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * Class AuthServiceProvider
 * @package App\Modules\Users
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class AuthServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot()
    {
        $request = request();

        /** register api v1 routes */
        if (app()->get('accept')->parseApiVersion($request) === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Auth\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }
    }

    public function register()
    {
        $this->app->bind('App\Interfaces\Services\IAuthService', 'App\Modules\Auth\Services\AuthService');
        $this->app->bind('App\Interfaces\App\IAuth', 'App\Modules\Auth\App\Auth');
    }

}
