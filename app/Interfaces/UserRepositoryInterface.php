<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function registerUser($request);
    public function loginUser($request);
    public function logoutUser($request);
    public function getUserByEmail(string $email);
    public function me();
}
