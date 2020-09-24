<?php
namespace App\Modules\Transactions;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Interfaces\Services\ITransactionService;
use App\Modules\Transactions\Services\TransactionService;
use App\Interfaces\App\ITransaction;
use App\Modules\Transactions\App\Transaction;

/**
 * Class TransactionsServiceProvider
 * @package App\Modules\Transactions
 * @method \App\Http\Parser\Accept parseApiVersion()
 */
class TransactionsServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot()
    {
        /** register api v1 routes */
        if ($this->app->get('accept')->parseApiVersion() === 'v1') {
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Modules\Transactions\Controllers\Api\V1')
                ->group(__DIR__ . '/Controllers/Api/V1/routes.php');
        }
    }

    public function register()
    {
        $this->app->singleton(ITransactionService::class, TransactionService::class);
        $this->app->singleton(ITransaction::class, Transaction::class);
    }

}
