<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\DAO\ITransactionDAO;
use App\Modules\Transactions\Models\TransactionRepository as Model;

class TransactionRepository
{
    public function create(ITransactionDAO $dao, int $userId, int $walletId)
    {
        Model::create(
            $dao->getFrom(),
            $dao->getTo(),
            $dao->getAmount(),
            $dao->getFee(),
            $dao->getResult(),
            $userId,
            $walletId
        );
    }
}
