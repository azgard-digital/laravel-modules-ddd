<?php
declare(strict_types=1);

namespace App\Interfaces\App;

use App\DTO\TransactionDTO;
use Illuminate\Database\Eloquent\Collection;

interface ITransaction
{
    /**
     * @param int $userId
     * @param string $from
     * @param string $to
     * @param int $amount
     * @return TransactionDTO
     */
    public function store(int $userId, string $from, string $to, int $amount): TransactionDTO;

    /**
     * @param int $userId
     * @return array
     */
    public function transactions(int $userId): Collection;
}
