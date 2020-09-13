<?php


namespace App\Interfaces\DAO;


interface IUserAuthDAO
{
    public function getName(): string;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return string
     */
    public function getExpire(): string;
}