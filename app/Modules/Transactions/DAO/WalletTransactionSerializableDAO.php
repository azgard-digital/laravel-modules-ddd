<?php


namespace App\Modules\Transactions\DAO;


final class WalletTransactionSerializableDAO implements \JsonSerializable
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var int
     */
    private $fee;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $info;

    public function __construct(int $amount, int $fee, int $status, string $info)
    {
        $this->amount = $amount;
        $this->fee = $fee;
        $this->status = $status;
        $this->info = $info;
    }

    public function jsonSerialize()
    {
        return [
            'amount' => $this->amount,
            'fee' => $this->fee,
            'status' => $this->status,
            'info' => $this->info,
        ];
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getFee(): int
    {
        return $this->fee;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getInfo(): string
    {
        return $this->info;
    }
}
