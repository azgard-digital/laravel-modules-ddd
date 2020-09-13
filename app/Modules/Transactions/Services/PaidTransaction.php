<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\DAO\ITransactionDAO;
use App\Modules\Transactions\DAO\TransactionDAO;

class PaidTransaction extends ATransaction
{
    public function process(string $from, string $to, int $amount):ITransactionDAO
    {
        $fee = $this->calculateFee($amount);
        $result = $this->walletRepository->processTransaction($from, $to, $amount, $fee);
        $dao = new TransactionDAO($from, $to, $amount, $fee, $result);
        $this->addToTransactionLog($dao);
        return $dao;
    }

    protected function calculateFee(int $amount):int
    {
        return (int)round(($amount * 1.5) / 100);
    }
}
