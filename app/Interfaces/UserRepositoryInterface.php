<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function registerUser($request);
    public function loginUser($request);
    public function logoutUser($request);
    public function getUserByEmail(string $email);
}
