<?php

namespace App\Repositories\Contracts;

use App\DataObjects\UserRegisterData;
use App\Models\User;

interface UserRepositoryContract
{
    /**
     * @param UserRegisterData $data
     * @return User
     */
    public function create(UserRegisterData $data): User;
}