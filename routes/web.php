<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OperarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'login')->name('logininicio');
Route::post('/login-usuario', [OperarioController::class, 'login'])->name('login');

Route::view('/registrar', 'registrar')->name('registrarinicio');
Route::post('/registrar-usuario', [OperarioController::class, 'registro'])->name('registrar');
