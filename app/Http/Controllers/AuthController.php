<?php

namespace App\Http\Controllers;

use App\Http\Actions\Users\LoginAction;
use App\Http\Actions\Users\RegisterAction;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $registerAction)
    {
        $user = $registerAction->handle(
            $request->input("pseudo"),
            $request->input("password")
        );

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $user = $loginAction->handle(
            $request->input("pseudo"),
            $request->input("password")
        );

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Disconnected']);
    }
}
