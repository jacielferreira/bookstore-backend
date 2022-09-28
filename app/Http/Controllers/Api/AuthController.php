<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {}

    public function registerUser(UserRequest $userRequest): JsonResponse
    {
        return $this->userRepository->registerUser($userRequest);
    }

    public function loginUser(LoginRequest $loginRequest)
    {
        return $this->userRepository->loginUser($loginRequest);
    }

    public function logoutUser(Request $request)
    {
        return $this->userRepository->logoutUser($request);
    }

    public function me()
    {
        return $this->userRepository->me();
    }
}
