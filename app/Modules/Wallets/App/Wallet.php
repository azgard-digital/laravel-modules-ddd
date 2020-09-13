<?php


namespace App\Modules\Wallets\App;


use App\Interfaces\App\IWallet;
use App\Interfaces\DAO\IWalletDAO;
use App\Interfaces\Services\IWalletService;

class Wallet implements IWallet
{
    private $service;

    public function __construct(IWalletService $service)
    {
        $this->service = $service;
    }

    public function create(int $userId):IWalletDAO
    {
        return $this->service->create($userId);
    }

    public function getByAddress(string $address, int $userId):IWalletDAO
    {
        return $this->service->getByAddress($address, $userId);
    }
}
