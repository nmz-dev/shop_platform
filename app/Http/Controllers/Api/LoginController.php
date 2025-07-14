<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Sodium\add;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if(auth()->attempt($request->only('email', 'password'))){
            $user = auth()->user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token]);
        }
        return response()->json(['message' => 'Invalid credentials!'],401);
    }
}
