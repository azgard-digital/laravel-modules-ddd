<?php


namespace App\Interfaces\DAO;


interface IAuthLoginDAO
{
    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getExpire(): string;
}
