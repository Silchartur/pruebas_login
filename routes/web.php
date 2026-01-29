<?php

use App\Http\Controllers\AdministrativosController;
use App\Http\Controllers\GestoresController;
use App\Http\Controllers\OperariosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//LOGIN
Route::view('/login', 'login')->name('logininicio');
Route::post('/login-usuario', [UsuariosController::class, 'login'])->name('login');

//CREAR NUEVO USUARIO (sólo puede acceder GESTOR)
Route::view('/registrar', 'registrar')->name('registrarinicio');
Route::post('/registrar-usuario', [UsuariosController::class, 'registro'])->name('registrar');

//Visualizar usuarios --> GESTOR
Route::get('/listadoUsuarios', [UsuariosController::class, 'listadoUsuarios'])->name('listadoUsuarios');;

//UPDATE usuarios --> GESTOR
Route::put('/gestor/{id}', [GestoresController::class, 'update'])->name('gestor_update');
Route::put('/administrativo/{id}', [AdministrativosController::class, 'update'])->name('administrativo_update');
Route::put('/operario/{id}', [OperariosController::class, 'update'])->name('operario_update');


