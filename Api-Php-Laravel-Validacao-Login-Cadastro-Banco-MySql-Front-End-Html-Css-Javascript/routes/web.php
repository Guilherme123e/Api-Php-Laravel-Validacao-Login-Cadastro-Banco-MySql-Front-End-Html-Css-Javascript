<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rota para exibir o formulário de cadastro
Route::get('/cadastro', function () {
    return view('cadastro'); // resources/views/cadastro.blade.php
});

// Rota para processar o formulário (registro do usuário)
Route::post('/register', [AuthController::class, 'register']);

// Rota para exibir o formulário de login
Route::get('/login', function () {
    return view('login');
});

// Rota para processar o formulário (login do usuário)
Route::post('/login', [AuthController::class, 'login']);


// Rota para exibir login-sucesso
Route::get('/login-sucesso', function () {
    return view('login-sucesso');
});

Route::post('/login-sucesso', [AuthController::class, 'login-sucesso']);


// Rota para exibir cadastro-sucesso
Route::get('/cadastro-sucesso', function () {
    return view('cadastro-sucesso');
});


Route::post('/cadastro-sucesso', [AuthController::class, 'cadastro-sucesso']);
