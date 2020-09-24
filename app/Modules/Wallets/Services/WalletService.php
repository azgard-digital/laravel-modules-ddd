<?php
declare(strict_types=1);

namespace App\Modules\Wallets\Services;

use App\DTO\WalletDTO;
use App\Exceptions\ResourceException;
use App\Interfaces\Services\ICalculator;
use App\Interfaces\Services\IWalletService;
use App\Modules\Wallets\Models\WalletRepository;
use Illuminate\Support\Collection;

class WalletService implements IWalletService
{
    private const WALLETS_LIMIT = 9;
    private const DEFAULT_BALANCE = 100000000;

    private $currencyService;
    private $walletRepository;

    public function __construct(
        CurrencyService $currencyService,
        WalletRepository $walletRepository
    ) {
        $this->currencyService = $currencyService;
        $this->walletRepository = $walletRepository;
    }

    public function isLimited(int $userId): bool
    {
        return ($this->walletRepository->getWalletsCount($userId) >= self::WALLETS_LIMIT);
    }

    protected function createWalletAddress(string $prefix): string
    {
        return md5(uniqid($prefix, true));
    }

    public function create(int $userId): WalletDTO
    {
        $address = $this->createWalletAddress((string)$userId);

        if (!$this->walletRepository->createUserWallet($userId, $address, self::DEFAULT_BALANCE)) {
            throw new ResourceException('Wallet has not been created');
        }

        return new WalletDTO(
            $address,
            $this->currencyService->convertToBtc(self::DEFAULT_BALANCE),
            $this->currencyService->convertToUsd(self::DEFAULT_BALANCE)
        );
    }

    public function getWalletByAddress(string $address, int $userId): WalletDTO
    {
        $wallet = $this->walletRepository->getUserWalletByAddress($address, $userId);

        if (!$wallet) {
            throw new ResourceException('Wallet has not been found');
        }

        return new WalletDTO(
            $address,
            $this->currencyService->convertToBtc($wallet->balance),
            $this->currencyService->convertToUsd($wallet->balance)
        );
    }

    public function isWalletExist(int $userId, string $address): bool
    {
        return $this->walletRepository->isUserWalletExist($userId, $address);
    }

    public function putTransaction(string $to, ICalculator $calculate): void
    {
        $this->walletRepository->putTransaction($to, $calculate);
    }

    public function takeTransaction(string $from, ICalculator $calculate): void
    {
        $this->walletRepository->takeTransaction($from, $calculate);
    }

    public function getWalletIdByAddress(string $address, int $userId): ?int
    {
        $wallet = $this->walletRepository->getUserWalletByAddress($address, $userId);

        if (!$wallet) {
            return null;
        }

        return $wallet->getAttribute('id');
    }

    public function getTransactionsByAddress(string $address): Collection
    {
        return $this->walletRepository->getTransactionsByAddress($address);
    }
}
