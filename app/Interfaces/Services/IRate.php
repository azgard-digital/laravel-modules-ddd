<?php


namespace App\Interfaces\Services;


interface IRate
{
    /**
     * @return bool
     */
    public function isConvertible():bool;

    /**
     * @return float|null
     */
    public function getUsd():?float;
}
