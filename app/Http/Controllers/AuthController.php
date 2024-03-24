<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {


    public function register(AuthRegisterRequest $request) {

        $user = User::create([
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);


        if (!$user) {
            return response()->json(['message' => 'Registration failed'], 500);
        }


        $token = $user->createToken('Personal Access Token')->accessToken;


        return ['token' => $token];
    }

    public function login(AuthLoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (!\Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user        = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token       = $tokenResult->token;


        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

}
