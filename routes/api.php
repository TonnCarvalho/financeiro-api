<?php

use App\Http\Controllers\Api\V1\Auth\TokenController;
use App\Http\Controllers\Api\V1\Banco\BancoController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::post('/login', [TokenController::class, 'tokenLogin']);
});

Route::prefix('/v1')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/user', function () {
            return response()->json([
                'message' => 'acesso com sucesso',
                'data' => [
                    'usuario' => 'Cleiton',
                ],
            ], 200);
        });

        Route::resource('banco', BancoController::class);

    });
