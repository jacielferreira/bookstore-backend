<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function createUser(array $user);
    public function logoutUser($request);
    public function getUserByEmail(string $email);
}
