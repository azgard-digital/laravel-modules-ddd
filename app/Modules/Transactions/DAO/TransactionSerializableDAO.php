<?php


namespace App\Modules\Transactions\DAO;


final class TransactionSerializableDAO implements \JsonSerializable
{
    /**
     * @var string
     */
    private $from;

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

    public function __construct(string $from, int $amount, int $fee, int $status, string $info)
    {
        $this->from = $from;
        $this->amount = $amount;
        $this->fee = $fee;
        $this->status = $status;
        $this->info = $info;
    }

    public function jsonSerialize()
    {
        return [
            'from' => $this->from,
            'amount' => $this->amount,
            'fee' => $this->fee,
            'status' => $this->status,
            'info' => $this->info,
        ];
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
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
