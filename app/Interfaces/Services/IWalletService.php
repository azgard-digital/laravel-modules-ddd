<?php
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTO\WalletDTO;
use Illuminate\Support\Collection;

interface IWalletService
{
    /**
     * @param int $userId
     * @return bool
     */
    public function isLimited(int $userId): bool;

    /**
     * @param int $userId
     * @return WalletDTO
     */
    public function create(int $userId): WalletDTO;

    /**
     * @param string $address
     * @param int $userId
     * @return WalletDTO
     */
    public function getWalletByAddress(string $address, int $userId): WalletDTO;

    /**
     * @param int $userId
     * @param string $address
     * @return bool
     */
    public function isWalletExist(int $userId, string $address): bool;

    /**
     * @param string $to
     * @param ICalculator $calculate
     */
    public function putTransaction(string $to, ICalculator $calculate): void;

    /**
     * @param string $from
     * @param ICalculator $calculate
     */
    public function takeTransaction(string $from, ICalculator $calculate): void;

    /**
     * @param string $address
     * @param int $userId
     * @return int|null
     */
    public function getWalletIdByAddress(string $address, int $userId): ?int;

    /**
     * @param string $address
     * @return Collection
     */
    public function getTransactionsByAddress(string $address): Collection;
}

