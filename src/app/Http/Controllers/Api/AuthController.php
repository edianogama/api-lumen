<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str as StrHelp;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);
        
        if (!User::where('username', $request->username)->whereNull('fb_id')->first()){
            return response()->json(['message' => 'Usuário logado via facebook'], 401);
        }
        
        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token,['user' => Auth::user()]);
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
    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }

    public function facebookSignin(Request $request): JsonResponse
    {
        $this->validate($request, [
            'access_token' => 'required',
        ]);

        try {
            $response = Socialite::with('facebook')->userFromToken($request->access_token);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return response()->json(
                ['error'=> true,
                'message' => 'OOPS! Um erro ocorreu ao tentar sincronizar com sua conta Facebook. Tente novamente!',
                'error_from_server' => json_encode($e->getMessage()),
                ]
            );
        }

        $user = User::where('fb_id', $response->id)->first();
        if ($user) {
            return $this->respondWithToken(Auth::login($user), ['user' => $user]);
        }

        $planPassword = app('hash')->make($response->id);
        $user = (new User)->create([
            'username' => StrHelp::slug($response->name),
            'password' => $planPassword,
            'fb_id' => $response->id
        ]);

        return $this->respondWithToken(Auth::login($user), ['user' => $user]);
    }

}