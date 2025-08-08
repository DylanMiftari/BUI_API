<?php

namespace App\Http\Controllers;

use App\Helpers\With;
use App\Http\Actions\Users\LoginAction;
use App\Http\Actions\Users\RegisterAction;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getUser()
    {
        With::add("userMoney");
        With::add("dashboard");
        return new UserResource(Auth::user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Disconnected']);
    }
}
