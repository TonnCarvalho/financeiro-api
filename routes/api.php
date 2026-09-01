<?php
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response()->json([
        'message' => 'acesso com sucesso',
        'data' => [
            'usuario' => 'Cleiton',
        ],
    ], 200);
});


