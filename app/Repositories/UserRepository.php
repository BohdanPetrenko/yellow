<?php

namespace App\Repositories;

use App\DataObjects\UserRegisterData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    /**
     * @param User $user
     */
    public function __construct(
        private User $user
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function create(UserRegisterData $data): User
    {
        return $this->user->newQuery()->create($data->toStore());
    }
}