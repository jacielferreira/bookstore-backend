<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\Api\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {}

    public function registerUser(UserRequest $userRequest)
    {
        try{
            $user = $this->userService->create([
                'name' => $userRequest->name,
                'email' => $userRequest->email,
                'password' => Hash::make($userRequest->password)
            ]);
            response()->json(["message"=> "User created successfully", "data" => $user], 200);
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

            $user = $this->userService->getUserByEmail($loginRequest->email);
            return response()->json(["message"=> "User logged in successfully", "token" => $user->createToken('API TOKEN')
                ->plainTextToken], 200);

        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
