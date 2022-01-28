<?php

namespace App\Repositories\Contracts;

use App\DataObjects\UserRegisterData;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepositoryContract
{
    /**
     * @param UserRegisterData $data
     * @return User
     */
    public function create(UserRegisterData $data): User;

    /**
     * @param string $email
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByEmail(string $email): User;
}