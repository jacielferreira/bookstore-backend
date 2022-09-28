<?php

namespace App\Repositories;

use App\Http\Resources\User\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $user
    )
    {}

    public function registerUser($request)
    {
        try{
            $user = $request->only([
                'name',
                'email',
                'password'
            ]);
            return response()->json(["message"=> "User created successfully", "data" =>
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password'])
                ])], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function loginUser($request)
    {
        try{
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json(["message" => 'Email & Password does not match.'], Response::HTTP_UNAUTHORIZED);
            }
            $user = auth('sanctum')->user();
            return response()->json(["message"=> "User logged in successfully", "token" => $user->createToken('API TOKEN')
                ->plainTextToken], Response::HTTP_CREATED);
        }
        catch (\Throwable $th){
            return response()->json(["message" => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUserByEmail(string $email)
    {
        return $this->user->where('email', $email)->firstOrFail();
    }

    public function logoutUser($request)
    {
        auth('sanctum')->user()->tokens()->delete();
        return response(['message'=>'Successfully Logging out']);
    }

    public function me()
    {
        try{
            $user = auth('sanctum')->user();
            $userResource = new UserResource($user);
            return response()->json($userResource, Response::HTTP_CREATED);
        }
        catch (\Throwable $th){

        }
    }
}
