<?php


namespace App\Interfaces\App;


use App\Interfaces\DAO\IWalletDAO;

interface IWallet
{
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
     * @param string $address
     * @return array
     */
    public function getTransactionsByAddress(string $address):array;
}
