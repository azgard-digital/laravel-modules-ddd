<?php


namespace App\Modules\Wallets\Models;

use App\Exceptions\ResourceException;
use App\Exceptions\ServerException;
use App\Exceptions\StoreResourceFailedException;
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
}
