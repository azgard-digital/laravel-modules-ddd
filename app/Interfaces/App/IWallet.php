<?php
declare(strict_types=1);

namespace App\Interfaces\App;

use App\DTO\WalletDTO;
use Illuminate\Support\Collection;

interface IWallet
{
    /**
     * @param int $userId
     * @return WalletDTO
     */
    public function store(int $userId): WalletDTO;

    /**
     * @param string $address
     * @param int $userId
     * @return WalletDTO
     */
    public function show(string $address, int $userId): WalletDTO;

    /**
     * @param string $address
     * @return array
     */
    public function transactions(string $address): Collection;
}
