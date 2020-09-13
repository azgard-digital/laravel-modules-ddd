<?php


namespace App\Modules\Auth\DAO;


use App\Interfaces\DAO\IAuthLoginDAO;

class AuthLoginDAO implements IAuthLoginDAO
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $expire;

    /**
     * AuthLoginDAO constructor.
     * @param string $token
     * @param string $expire
     */
    public function __construct(string $token, string $expire)
    {
        $this->token = $token;
        $this->expire = $expire;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpire(): string
    {
        return $this->expire;
    }
}
