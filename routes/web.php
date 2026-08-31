<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return abort(303, 'Ola');
});

Route::post('/login', [LoginController::class, 'login']);