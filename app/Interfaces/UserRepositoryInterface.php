<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function createUser(array $user);
    public function getUserByEmail(string $email);
}
