<?php


namespace App\Modules\Wallets\DAO;


final class WalletInfoDAO
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $balance;

    /**
     * @var int
     */
    private $userId;

    public function __construct(string $address, int $balance, int $userId)
    {
        $this->address = $address;
        $this->balance = $balance;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

}
