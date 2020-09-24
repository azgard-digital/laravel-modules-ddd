<?php
declare(strict_types=1);

namespace App\DTO;

class AuthLoginDTO
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
     * AuthLoginDTO constructor.
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
