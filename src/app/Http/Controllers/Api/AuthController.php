<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

 
    public function register(Request $request): JsonResponse
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        try {
            $planPassword = app('hash')->make($request->input('password'));
            $user = (new User)->create([
                'username' => $request->input('username'),
                'password' => $planPassword,
            ]);

            return response()->json(['user' => $user, 'message' => 'created'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }


}