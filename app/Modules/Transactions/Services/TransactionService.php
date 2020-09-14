<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\DAO\ITransactionDAO;
use App\Interfaces\Services\ITransactionService;

class TransactionService implements ITransactionService
{
    /**
     * @var WalletRepository
     */
    private $walletRepository;

    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    public function __construct(WalletRepository $walletRepository, TransactionRepository $transactionRepository)
    {
        $this->walletRepository = $walletRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function create(int $userId, string $from, string $to, int $amount):ITransactionDAO
    {
        $factory = new TransactionFactory($this->transactionRepository, $this->walletRepository);
        $transaction = $factory->transaction($userId, $to);
        return $transaction->process($from, $to, $amount);
    }

    public function isExistUserWallet(int $userId, string $address):bool
    {
        return $this->walletRepository->isExistUserWallet($userId, $address);
    }

    public function getUserTransactions(int $userId):array
    {
        return $this->transactionRepository->getUserTransactions($userId);
    }

    public function getWalletTransactions(int $walletId):array
    {
        return $this->transactionRepository->getWalletTransactions($walletId);
    }
}
