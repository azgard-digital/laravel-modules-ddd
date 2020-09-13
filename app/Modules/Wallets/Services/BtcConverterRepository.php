<?php


namespace App\Modules\Wallets\Services;


class BtcConverterRepository
{
    public function convertBalanceToBtc(int $balance):string
    {
        return number_format((float)($balance / 100000000), 4, '.', '');
    }
}
