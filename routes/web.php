<?php

use App\Http\Controllers\AdministrativosController;
use App\Http\Controllers\GestoresController;
use App\Http\Controllers\OperariosController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//LOGIN Y LOGOUT (todos pueden entrar y salir?)
Route::view('/login', 'login')->name('login');
Route::post('/login-usuario', [UsuariosController::class, 'login']);
Route::post('/logout', [UsuariosController::class, 'logout']);


// RUTAS SOLO PARA GESTOR 
Route::middleware('auth:gestor')->group(function () {

    // crear usuario
    Route::view('/registrar', 'registrar')->name('registrarinicio');
    Route::post('/registrar-usuario', [UsuariosController::class, 'registro'])->name('registrar');

    // listado usuarios
    Route::get('/listadoUsuarios', [UsuariosController::class, 'listadoUsuarios'])
        ->name('listadoUsuarios');

    // updates
    Route::put('/gestor/{id}', [GestoresController::class, 'update'])
        ->name('gestor_update');

    Route::put('/administrativo/{id}', [AdministrativosController::class, 'update'])
        ->name('administrativo_update');

    Route::put('/operario/{id}', [OperariosController::class, 'update'])
        ->name('operario_update');
});


//RUTAS PARA USUARIOS LOGUEADOS 
Route::middleware(['auth:gestor,administrativo,operario'])->group(function () {

    Route::get('/usuario', [UsuariosController::class, 'usuarioActual']);

    Route::post('/logout', [UsuariosController::class, 'logout']);
});
