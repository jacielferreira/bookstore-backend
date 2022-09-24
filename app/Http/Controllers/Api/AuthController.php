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
        try{
            $user = $userRequest->only([
                'name',
                'email',
                'password'
            ]);
            return response()->json(["message"=> "User created successfully", "data" =>
                $this->userRepository->createUser([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password'])
                ])], ResponseAlias::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function loginUser(LoginRequest $loginRequest)
    {
        try{
            if(!Auth::attempt($loginRequest->only(['email', 'password']))){
                return response()->json(["message" => 'Email & Password does not match.'], 401);
            }
            $user = $this->userRepository->getUserByEmail($loginRequest->email);
            return response()->json(["message"=> "User logged in successfully", "token" => $user->createToken('API TOKEN')
                ->plainTextToken], 200);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    public function logoutUser(LoginRequest $loginRequest)
    {
        return $this->userRepository->logoutUser($loginRequest);
    }
}
