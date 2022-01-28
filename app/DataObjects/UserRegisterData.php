<?php

namespace App\DataObjects;

class UserRegisterData
{
    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $phone
     */
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $password,
        private string $phone,
    )
    {
    }

    /**
     * @return array
     */
    public function toStore(): array
    {
        return [
            'first_name'     => $this->firstName,
            'last_name'      => $this->lastName,
            'email'          => $this->email,
            'password'       => password_hash($this->password, PASSWORD_BCRYPT),
            'phone'          => $this->phone,
//            'remember_token' =>
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
            $data['password'],
            $data['phone'],
        );
    }
}