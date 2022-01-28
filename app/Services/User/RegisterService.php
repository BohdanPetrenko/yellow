<?php

namespace App\Services\User;

use App\DataObjects\UserRegisterData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class RegisterService
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
}
