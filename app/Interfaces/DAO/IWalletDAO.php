<?php


namespace App\Interfaces\DAO;


interface IWalletDAO
{
    public function getAddress(): string;

    /**
     * @return string
     */
    public function getBtcBalance(): string;

    /**
     * @return string
     */
    public function getUsdBalance(): string;
}
