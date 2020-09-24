<?php
declare(strict_types=1);

namespace App\Modules\Transactions\Models;

use App\DTO\TransactionDTO;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository
{
    public function getUserTransactions(int $userId): Collection
    {
        return Transaction::query()
            ->where('user_id', $userId)
            ->get([
                'id',
                'created_at',
                'updated_at',
                'status',
                'amount',
                'fee',
                'details'
            ]);
    }

    public function createUserTransaction(TransactionDTO $dto): bool
    {
        $model = new Transaction();

        $transaction = $model->fill([
            'user_id' => $dto->getUserId(),
            'wallet_id' => $dto->getWalletId(),
            'amount' => $dto->getAmount(),
            'fee' => $dto->getFee(),
            'status' => $dto->getResult(),
            'details' => ['from' => $dto->getFrom(), 'to' => $dto->getTo()]
        ]);

        return $transaction->save();
    }
}
