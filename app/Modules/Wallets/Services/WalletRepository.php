<?php


namespace App\Modules\Wallets\Services;

use App\Modules\Wallets\Models\WalletRepository as Model;

class WalletRepository
{
    public function count(int $userId):int
    {
        return Model::countByUser($userId);
    }

    public function create(int $userId, int $balance, string $address):bool
    {
       return Model::create($balance, $userId, $address);
    }

    public function getByAddress(string $address, int $userId):int
    {
        return Model::getByAddress($address, $userId);
    }

    public function createWalletAddress(int $userId):string
    {
        return md5(uniqid($userId));
    }

    public function isExistUserWallet(int $userId, string $address):bool
    {
        return Model::isExistUserWallet($userId, $address);
    }

    public function processTransaction(string $from, string $to, int $amount, int $fee):bool
    {
        return Model::processTransaction($from, $to, $amount, $fee);
    }

    public function getWalletIdByAddress(string $address):int
    {
        return Model::getWalletIdByAddress($address);
    }

}
