<?php


namespace App\Modules\Wallets\Services;

use App\Interfaces\DAO\IWalletDAO;
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
}
