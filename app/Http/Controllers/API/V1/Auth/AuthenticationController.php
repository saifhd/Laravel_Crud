<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\Auth\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return new UsersResource($user);
    }

    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated())){
            return response()->json([
                'message' => 'Incorrect Details. Please try again',
                'errors' => [],
                'success' => false
            ],422);
        }
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;

        return new UsersResource($user);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->delete();

        return response()->json([
            "data" => [],
            "status" => "OK",
            "errors" => null,
            "success" => true
        ]);
    }
}
