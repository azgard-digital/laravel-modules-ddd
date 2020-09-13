<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\DAO\ITransactionDAO;

abstract class ATransaction
{
    /**
     * @var TransactionRepository
     */
    protected $transactionRepository;

    /**
     * @var WalletRepository
     */
    protected $walletRepository;

    /**
     * @var int
     */
    protected $userId;

    public function __construct(
        TransactionRepository $transactionRepository,
        WalletRepository $walletRepository,
        int $userId
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
        $this->userId = $userId;
    }

    abstract public function process(string $from, string $to, int $amount):ITransactionDAO;

    protected function addToTransactionLog(ITransactionDAO $dao):void
    {
        $walletId = $this->walletRepository->getWalletIdByAddress($dao->getFrom());
        $this->transactionRepository->create($dao, $this->userId, $walletId);
    }
}
