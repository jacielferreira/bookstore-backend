<?php

namespace App\Services\Api;

use App\Models\User;

class UserService
{
    public function create($user)
    {
       $user = User::create($user);
       return response()->json(["message"=> "User created successfully", "data" => $user], 200);
    }
}
