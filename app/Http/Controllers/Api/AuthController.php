<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    {
    }

    public function registerUser(Request $request)
    {
        try{
            return $this->userService->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
        catch(\Throwable $th){
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
