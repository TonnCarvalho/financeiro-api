<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function tokenLogin(LoginRequest $loginRequest)
    {
        $credencial = $loginRequest->validated();

        $usuario = Usuario::query()
            ->where('email', $credencial['email'])
            ->first();

        if (! $usuario || ! Hash::check($credencial['senha'], $usuario->senha)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas.',
            ], 401);
        }

        $token = $usuario
            ->createToken('api-token')
            ->plainTextToken;

        return response()->json([
            'credencial' => $credencial,
            'token' => $token,
            'usuario' => $usuario,
        ]);
    }
}
