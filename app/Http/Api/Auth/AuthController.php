<?php

namespace App\Http\Api\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController
{
    public function login(Request $request)
    {
        $missingFields = [];
        if (!$request->has('email')) {
            $missingFields[] = 'email';
        }
        if (!$request->has('password')) {
            $missingFields[] = 'senha';
        }
        if (!empty($missingFields)) {
            $errorMessage = 'Informe ' . implode(' e ', $missingFields);
            return response()->json(['error' => $errorMessage], 400);
        }
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar o token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Falha ao fazer logout'], 500);
        }
    }
}

