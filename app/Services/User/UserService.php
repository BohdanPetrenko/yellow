<?php

namespace App\Services\User;

use App\DataObjects\UserRegisterData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use InvalidArgumentException;

class UserService
{
    /**
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(
        private UserRepositoryContract $userRepository
    )
    {
    }

    /**
     * @param UserRegisterData $data
     * @return User
     */
    public function register(UserRegisterData $data): User
    {
        return $this->userRepository->create($data);
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     * @throws InvalidArgumentException
     */
    public function isUserPassword(string $email, string $password): bool
    {
        $user = $this->userRepository->findByEmail($email);

        return $user->isSamePassword($password) ? true : throw new InvalidArgumentException('Wrong user password');
    }
}