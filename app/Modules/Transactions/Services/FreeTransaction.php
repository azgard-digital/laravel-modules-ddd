<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\DAO\ITransactionDAO;
use App\Modules\Transactions\DAO\TransactionDAO;

class FreeTransaction extends ATransaction
{
    public function process(string $from, string $to, int $amount):ITransactionDAO
    {
        $result = $this->walletRepository->processTransaction($from, $to, $amount, 0);
        $dao = new TransactionDAO($from, $to, $amount, 0, $result);
        $this->addToTransactionLog($dao);
        return $dao;
    }
}
