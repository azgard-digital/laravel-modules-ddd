<?php


namespace App\Interfaces\Services;


use App\Interfaces\DAO\ITransactionDAO;

interface ITransactionService
{
    /**
     * @param int $userId
     * @param string $from
     * @param string $to
     * @param int $amount
     * @return ITransactionDAO
     */
    public function create(int $userId, string $from, string $to, int $amount):ITransactionDAO;

    /**
     * @param int $userId
     * @param string $address
     * @return bool
     */
    public function isExistUserWallet(int $userId, string $address):bool;

    /**
     * @param int $userId
     * @return array
     */
    public function getUserTransactions(int $userId):array;

    /**
     * @param int $walletId
     * @return array
     */
    public function getWalletTransactions(int $walletId):array;
}
