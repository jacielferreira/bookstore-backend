<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected User $user
    )
    {}

    public function createUser(array $user)
    {
       $this->user->create($user);
    }

    public function getUserByEmail(string $email)
    {
        $this->user->where('email', $email)->firstOrFail();
    }
}
