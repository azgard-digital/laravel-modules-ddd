<?php
namespace App\Modules\Transactions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * Class TransactionsServiceProvider
 * @package App\Modules\Transactions
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class TransactionsServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot()
    {
        $request = request();

        /** register api v1 routes */
        if (app()->get('accept')->parseApiVersion($request) === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Transactions\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }

        Validator::extendImplicit('isCorrectTransactionWallet', function($attribute, $value, $parameters) {
            $user = $this->app->get('App\Interfaces\Services\IAuthService')->getLoggedUserId();

            if (!$user) {
                return false;
            }

            return $this->app->get('App\Interfaces\Services\ITransactionService')
                ->isExistUserWallet($user, $value);
        });
    }

    public function register()
    {
        $this->app->bind('App\Interfaces\Services\ITransactionService', 'App\Modules\Transactions\Services\TransactionService');
        $this->app->bind('App\Interfaces\App\ITransaction', 'App\Modules\Transactions\App\Transaction');
    }

}
