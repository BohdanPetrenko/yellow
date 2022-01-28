<?php

namespace App\ValueObject;

class PasswordObject
{
    /**
     * @param string $password
     */
    public function __construct(
        private string $password
    )
    {
    }

    /**
     * @return string
     */
    public function getHashed(): string
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }
}