<?php


namespace App\Modules\Wallets\Services;


use App\Interfaces\Services\ITransactionService;

class TransactionRepository
{
    private $transactionService;

    public function __construct(ITransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function getWalletTransactions(int $walletId):array
    {
        return $this->transactionService->getWalletTransactions($walletId);
    }
}
