<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\Services\IWalletService;

class WalletRepository
{
    private $service;

    public function __construct(IWalletService $service)
    {
        $this->service = $service;
    }

    public function isExistUserWallet(int $userId, string $address):bool
    {
        return $this->service->isExistUserWallet($userId, $address);
    }

    public function processTransaction(string $from, string $to, int $amount, int $fee):bool
    {
        return $this->service->processTransaction($from, $to, $amount, $fee);
    }

    public function getWalletIdByAddress(string $address):int
    {
        return $this->service->getWalletIdByAddress($address);
    }
}
