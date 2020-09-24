<?php
declare(strict_types=1);

namespace App\Modules\Users\DTO;

use App\Interfaces\DTO\IUserAuthDTO;

final class UserAuthDTO implements IUserAuthDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $expire;

    /**
     * UserCreateDTO constructor.
     * @param string $email
     * @param string $name
     * @param string $password
     */
    public function __construct(string $email, string $name, string $token, string $expire)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
        $this->expire = $expire;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getExpire(): string
    {
        return $this->expire;
    }
}
