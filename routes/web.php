<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'login')->name('logininicio');
Route::post('/login-usuario', [UsuariosController::class, 'login'])->name('login');

Route::view('/registrar', 'registrar')->name('registrarinicio');
Route::post('/registrar-usuario', [UsuariosController::class, 'registro'])->name('registrar');


Route::get('/listadoUsuarios', [UsuariosController::class, 'listadoUsuarios'])->name('listadoUsuarios');;
