<?php


namespace App\Modules\Transactions\Services;


use App\Exceptions\ResourceException;

final class TransactionFactory
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @var WalletRepository
     */
    private $walletRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        WalletRepository $walletRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
    }

    public function transaction(int $userId, string $to):ATransaction
    {
        if ($this->walletRepository->isExistUserWallet($userId, $to)) {
            return new FreeTransaction($this->transactionRepository, $this->walletRepository, $userId);
        }

        return new PaidTransaction($this->transactionRepository, $this->walletRepository, $userId);
    }
}
