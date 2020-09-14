<?php


namespace App\Interfaces\App;


use App\Interfaces\DAO\ITransactionDAO;

interface ITransaction
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
     * @return array
     */
    public function getUserTransactions(int $userId):array;
}
