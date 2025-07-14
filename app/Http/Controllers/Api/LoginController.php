<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Sodium\add;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token]);
        }
        return response()->json(['message' => 'Invalid credentials!'], 401);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create($request->all());
        if ($user) {
            $user->assignRole('customer');
            auth()->login($user);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token], 201);
        }
        return response()->json(['message' => 'Something went wrong'], 500);

    }

    public function getUser(Request $request)
    {
        return $request->user();
    }
}
