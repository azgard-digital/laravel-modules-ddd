<?php


namespace App\Modules\Wallets\Models;

use App\Exceptions\ResourceException;
use App\Exceptions\ServerException;
use App\Exceptions\StoreResourceFailedException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class WalletRepository
{
    public static function create(int $balance, int $user, string $address):bool
    {
        try {
            $model = new Wallet([
                'balance' => $balance,
                'user_id' => $user,
                'address' => $address
            ]);

            return (bool)$model->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new StoreResourceFailedException('Wallet has not been created!');
        }
    }

    public static function countByUser(int $user):int
    {
        try {
            return (int)Wallet::where('user_id', $user)->count();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new ServerException('Server error');
        }
    }

    public static function getByAddress(string $address, int $user):int
    {
        try {
            $wallet = Wallet::select('balance')
                ->where('user_id', $user)
                ->where('address', $address)
                ->first();

            if (!$wallet) {
                throw new ResourceException('Wallet has not been found!');
            }

            return (int)$wallet->getAttribute('balance');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new ServerException('Server error');
        }
    }

    public static function isExistUserWallet(int $user, string $address):bool
    {
        try {
            return Wallet::query()
                ->where('user_id', $user)
                ->where('address', $address)
                ->exists();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new ServerException('Server error');
        }
    }

    public static function processTransaction(string $from, string $to, int $amount, int $fee):bool
    {
        try {
            DB::beginTransaction();
            DB::statement('SET TRANSACTION ISOLATION LEVEL SERIALIZABLE');
            $walletFrom = Wallet::query()
                ->where('address', $from)
                ->lockForUpdate()
                ->first();

            $walletFromBalance = $walletFrom->getAttribute('balance');

            if ($walletFromBalance < ($amount + $fee)) {
                throw new ResourceException('Not enough money for transaction');
            }

            $walletTo = Wallet::query()
                ->where('address', $to)
                ->lockForUpdate()
                ->first();

            $walletToBalance = $walletTo->getAttribute('balance');

            $walletFrom->balance = $walletFromBalance - ($amount + $fee);
            $walletTo->balance = $walletToBalance + $amount;

            $walletFrom->save();
            $walletTo->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            if ($e instanceof ResourceException) {
                throw new ResourceException($e->getMessage());
            }
        }

        return false;
    }

    public static function getWalletIdByAddress(string $address):int
    {
        try {
            $wallet = Wallet::query()
                ->select(['id'])
                ->where('address', $address)
                ->first();

            return (int)$wallet->getAttribute('id');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new ServerException('Server error');
        }
    }
}
