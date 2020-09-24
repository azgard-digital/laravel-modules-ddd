<?php
declare(strict_types=1);

namespace App\Modules\Wallets\App;

use App\Interfaces\App\IWallet;
use App\DTO\WalletDTO;
use App\Interfaces\Services\IWalletService;
use Illuminate\Support\Collection;

class Wallet implements IWallet
{
    private $service;

    public function __construct(IWalletService $service)
    {
        $this->service = $service;
    }

    public function store(int $userId): WalletDTO
    {
        return $this->service->create($userId);
    }

    public function show(string $address, int $userId): WalletDTO
    {
        return $this->service->getWalletByAddress($address, $userId);
    }

    public function transactions(string $address): Collection
    {
        return $this->service->getTransactionsByAddress($address);
    }

}
