<?php
declare(strict_types=1);

namespace App\Modules\Wallets;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Services\IWalletService;
use App\Modules\Wallets\Services\WalletService;
use App\Interfaces\Services\IRate;
use App\Modules\Wallets\Services\Rate;
use App\Interfaces\App\IWallet;

/**
 * Class WalletsServiceProvider
 * @package App\Modules\Users
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class WalletsServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        /** register api v1 routes */
        if ($this->app->get('accept')->parseApiVersion() === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Wallets\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }
    }

    public function register()
    {
        $this->app->singleton(IWalletService::class, WalletService::class);
        $this->app->singleton(IWallet::class, WalletService::class);
        $this->app->singleton(IRate::class, Rate::class);
    }

}
