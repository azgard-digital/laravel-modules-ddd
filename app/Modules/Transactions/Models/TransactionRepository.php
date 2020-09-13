<?php


namespace App\Modules\Transactions\Models;

use App\Exceptions\StoreResourceFailedException;
use App\Interfaces\ITransactionStatus;
use Illuminate\Support\Facades\Log;

abstract class TransactionRepository
{
    public static function create(
        string $from,
        string $to,
        int $amount,
        int $fee,
        bool $result,
        int $userId,
        int $walletId
    ) {
        try {
            $model = new Transaction([
                'user_id' => $userId,
                'wallet_id' => $walletId,
                'amount' => $amount,
                'fee' => $fee,
                'status' => ($result) ? ITransactionStatus::SUCCESS : ITransactionStatus::FAIL,
                'details' => "Transaction from {$from} to {$to} wallet"
            ]);

            return (bool)$model->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new StoreResourceFailedException('Transaction has not been created!');
        }
    }
}
