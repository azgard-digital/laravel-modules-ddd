<?php


namespace App\Modules\Wallets\Services;


use App\Interfaces\Services\ITransactionService;

class TransactionRepository
{
    public function getWalletTransactions(int $walletId):array
    {
        return app()->get('App\Interfaces\Services\ITransactionService')->getWalletTransactions($walletId);
    }
}
