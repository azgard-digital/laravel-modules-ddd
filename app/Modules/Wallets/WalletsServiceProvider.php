<?php
namespace App\Modules\Wallets;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * Class WalletsServiceProvider
 * @package App\Modules\Users
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class WalletsServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot()
    {
        $request = request();

        /** register api v1 routes */
        if (app()->get('accept')->parseApiVersion($request) === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Wallets\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }

        Validator::extendImplicit('walletsLimit', function($attribute, $value, $parameters) {
            $wallet = $this->app->get('App\Interfaces\Services\IWalletService');
            $user = $this->app->get('App\Interfaces\Services\IAuthService')->getLoggedUserId();

            if (!$user) {
                return false;
            }

            return $wallet->count($user) < $wallet->limit();
        });
    }

    public function register()
    {
        $this->app->bind('App\Interfaces\Services\IWalletService', 'App\Modules\Wallets\Services\WalletService');
        $this->app->bind('App\Interfaces\App\IWallet', 'App\Modules\Wallets\App\Wallet');
        $this->app->singleton('App\Interfaces\Services\IRate', 'App\Modules\Wallets\Services\Rate');
    }

}
