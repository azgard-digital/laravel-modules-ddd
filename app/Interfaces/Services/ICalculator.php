<?php
declare(strict_types=1);

namespace App\Interfaces\Services;

interface ICalculator
{
    /**
     * @param int $balance
     * @return int
     */
    public function calculateFromBalance(int $balance): int;

    /**
     * @param int $balance
     * @return int
     */
    public function calculateToBalance(int $balance): int;

    /**
     * @return int
     */
    public function calculateAmountWithFee(): int;
}
