<?php

namespace App\DataObjects;

use App\ValueObject\PasswordObject;

class UserRegisterData
{
    /**
     * @param string         $firstName
     * @param string         $lastName
     * @param string         $email
     * @param PasswordObject $password
     * @param string         $phone
     */
    public function __construct(
        private string         $firstName,
        private string         $lastName,
        private string         $email,
        private PasswordObject $password,
        private string         $phone,
    )
    {
    }

    /**
     * @return array
     */
    public function toStore(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
            'email'      => $this->email,
            'password'   => $this->password->getHashed(),
            'phone'      => $this->phone,
        ];
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            new PasswordObject($data['password']),
            $data['phone'],
        );
    }
}