<?php


namespace App\Modules\Transactions\App;


use App\Interfaces\App\ITransaction;
use App\Interfaces\Services\ITransactionService;

class Transaction implements ITransaction
{
    private $service;

    public function __construct(ITransactionService $service)
    {
        $this->service = $service;
    }

    public function create(int $userId, string $from, string $to, int $amount)
    {
        return $this->service->create($userId, $from, $to, $amount);
    }

    public function getUserTransactions(int $userId):array
    {
        return $this->service->getUserTransactions($userId);
    }
}
