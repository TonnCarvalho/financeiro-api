<?php

use App\Http\Controllers\Api\V1\Auth\TokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {

    Route::get('/user', function () {
        return response()->json([
            'message' => 'acesso com sucesso',
            'data' => [
                'usuario' => 'Cleiton',
            ],
        ], 200);
    })->middleware('auth:sanctum');

    Route::post('/login', [TokenController::class, 'tokenLogin']);
});
