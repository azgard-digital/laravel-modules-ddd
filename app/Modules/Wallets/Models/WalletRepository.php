<?php
declare(strict_types=1);

namespace App\Modules\Wallets\Models;

use App\Exceptions\ResourceException;
use App\Interfaces\Services\ICalculator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WalletRepository
{
    public function takeTransaction(string $from, ICalculator $calculate): void
    {
        DB::transaction(function () use ($from, $calculate) {
            $walletFrom = Wallet::query()
                ->where('address', $from)
                ->lockForUpdate()
                ->first();

            $walletFromBalance = $walletFrom->balance;

            if ($walletFromBalance < $calculate->calculateAmountWithFee()) {
                throw new ResourceException('Not enough money for transaction');
            }

            $walletFrom->balance = $calculate->calculateFromBalance($walletFromBalance);
            $walletFrom->save();
        });
    }

    public function putTransaction(string $to, ICalculator $calculate): void
    {
        DB::transaction(function () use ($to, $calculate) {
            $walletTo = Wallet::query()
                ->where('address', $to)
                ->lockForUpdate()
                ->first();

            $walletToBalance = $walletTo->balance;

            $walletTo->balance = $calculate->calculateToBalance($walletToBalance);
            $walletTo->save();
        });
    }

    public function getTransactionsByAddress(string $address): Collection
    {
        return DB::table('wallets')
            ->join('transactions', 'wallets.id', '=', 'transactions.wallet_id')
            ->where('wallets.address', $address)
            ->get([
                'transactions.id',
                'transactions.created_at',
                'transactions.updated_at',
                'transactions.status',
                'transactions.amount',
                'transactions.fee'
            ]);
    }

    public function getWalletsCount(int $userId): int
    {
        return Wallet::query()->where('user_id', $userId)->count();
    }

    public function getUserWalletByAddress(string $address, int $userId): ?Wallet
    {
        $wallet = Wallet::query()
            ->where('user_id', $userId)
            ->where('address', $address)
            ->first();

        if (($wallet instanceof Wallet) === false) {
            return null;
        }

        return $wallet;
    }

    public function isUserWalletExist(int $userId, string $address): bool
    {
        return Wallet::query()
            ->where('user_id', $userId)
            ->where('address', $address)
            ->exists();
    }

    public function createUserWallet(int $userId, string $address, int $balance): bool
    {
        $model = new Wallet();

        $wallet = $model->fill([
            'balance' => $balance,
            'user_id' => $userId,
            'address' => $address
        ]);

        return $wallet->save();
    }
}
