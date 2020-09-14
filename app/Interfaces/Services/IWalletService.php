<?php


namespace App\Interfaces\Services;

use App\Interfaces\DAO\IWalletDAO;

interface IWalletService
{
    const WALLETS_LIMIT = 9;
    const DEFAULT_BALANCE = 100000000;

    /**
     * @return int
     */
    public function limit():int;

    /**
     * @param int $userId
     * @return IWalletDAO
     */
    public function create(int $userId):IWalletDAO;

    /**
     * @param string $address
     * @param int $userId
     * @return IWalletDAO
     */
    public function getByAddress(string $address, int $userId):IWalletDAO;

    /**
     * @param int $userId
     * @return int
     */
    public function count(int $userId):int;

    /**
     * @param int $userId
     * @param string $address
     * @return bool
     */
    public function isExistUserWallet(int $userId, string $address):bool;

    /**
     * @param string $from
     * @param string $to
     * @param int $amount
     * @param int $fee
     * @return bool
     */
    public function processTransaction(string $from, string $to, int $amount, int $fee):bool;

    /**
     * @param string $address
     * @return int
     */
    public function getWalletIdByAddress(string $address):int;

    /**
     * @param string $address
     * @return array
     */
    public function getTransactionsByAddress(string $address):array;
}
