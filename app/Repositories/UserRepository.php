<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected User $user
    )
    {}

    public function createUser(array $user)
    {
      return $this->user->create($user);
    }

    public function getUserByEmail(string $email)
    {
        return $this->user->where('email', $email)->firstOrFail();
    }

    public function logoutUser($request)
    {
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        $token->delete();
    }
}
