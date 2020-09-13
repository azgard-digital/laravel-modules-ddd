<?php


namespace App\Modules\Wallets\Services;


use App\Interfaces\Services\IRate;

class UsdConverterRepository
{
    private $rate;

    public function __construct(IRate $rate)
    {
        $this->rate = $rate;
    }

    public function convertBalanceToUsd(int $balance):string
    {
        if ($this->rate->isConvertible()) {
            $calculate = ($balance / 100000000) * $this->rate->getUsd();
            return number_format((float)$calculate, 4, '.', '');
        }

        return '';
    }
}
