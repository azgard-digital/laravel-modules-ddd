<?php
declare(strict_types=1);

namespace App\Modules\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Services\IAuthService;
use App\Modules\Auth\Services\AuthService;
use App\Interfaces\App\IAuth;
use App\Modules\Auth\App\Auth;

/**
 * Class AuthServiceProvider
 * @package App\Modules\Users
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class AuthServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        /** register api v1 routes */
        if ($this->app->get('accept')->parseApiVersion() === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Auth\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }
    }

    public function register()
    {
        $this->app->singleton(IAuthService::class, AuthService::class);
        $this->app->singleton(IAuth::class, Auth::class);
    }

}
