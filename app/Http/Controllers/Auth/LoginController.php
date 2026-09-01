<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $credenciais = $loginRequest->validated();

        if (! Auth::attempt($credenciais)) {
            return response()->json([
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        $loginRequest->session()->regenerate();

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'usuario' => Auth::user(),
        ]);
    }
}
