<?php


namespace App\Interfaces\DAO;


interface ITransactionDAO
{
    public function getFrom(): string;

    /**
     * @return string
     */
    public function getTo(): string;

    /**
     * @return int
     */
    public function getAmount(): int;

    /**
     * @return int
     */
    public function getFee(): int;

    /**
     * @return bool
     */
    public function getResult(): bool;
}
