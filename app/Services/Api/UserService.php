<?php

namespace App\Services\Api;

use App\Models\User;

class UserService
{
    public function create($user)
    {
       return User::create($user);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
