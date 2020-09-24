<?php
declare(strict_types=1);

namespace App\Modules\Transactions\App;

use App\DTO\TransactionDTO;
use App\Interfaces\App\ITransaction;
use App\Interfaces\Services\ITransactionService;
use Illuminate\Database\Eloquent\Collection;

class Transaction implements ITransaction
{
    private $service;

    public function __construct(ITransactionService $service)
    {
        $this->service = $service;
    }

    public function store(int $userId, string $from, string $to, int $amount): TransactionDTO
    {
        return $this->service->create($userId, $from, $to, $amount);
    }

    public function transactions(int $userId): Collection
    {
        return $this->service->getUserTransactions($userId);
    }
}
