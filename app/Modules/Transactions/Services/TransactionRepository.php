<?php


namespace App\Modules\Transactions\Services;


use App\Interfaces\DAO\ITransactionDAO;
use App\Modules\Transactions\DAO\TransactionSerializableDAO;
use App\Modules\Transactions\DAO\WalletTransactionSerializableDAO;
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

    public function getUserTransactions(int $userId):array
    {
        $items = Model::getUserTransactions($userId);
        $data = [];

        foreach ($items as $item) {
            $data[] = new TransactionSerializableDAO(
                $item->wallet->getAttribute('address'),
                $item->getAttribute('amount'),
                $item->getAttribute('fee'),
                $item->getAttribute('status'),
                $item->getAttribute('details')
            );
        }

        return $data;
    }

    public function getWalletTransactions(int $walletId):array
    {
        $items = Model::getWalletTransactions($walletId);
        $data = [];

        foreach ($items as $item) {
            $data[] = new WalletTransactionSerializableDAO(
                $item->getAttribute('amount'),
                $item->getAttribute('fee'),
                $item->getAttribute('status'),
                $item->getAttribute('details')
            );
        }

        return $data;
    }
}
