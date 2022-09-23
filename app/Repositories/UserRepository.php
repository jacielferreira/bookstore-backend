<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(
        protected User $user
    )
    {}

    public function create(array $attributes)
    {
        $this->user->insert($attributes);
    }

    public function getUserByEmail(array $attributes)
    {
        $this->user->where('email', $attributes['email'])->first();
    }

}
