<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use Illuminate\Http\Request;

class AdministrativosController extends Controller
{
    public function update(Request $request, $id)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email'
    ]);

    $admnistrativo = Administrativo::findOrFail($id);

    $admnistrativo->name = $request->name;
    $admnistrativo->email = $request->email;
    $admnistrativo->apellidos = $request->apellidos;
    $admnistrativo->telefono = $request->telefono;
    $admnistrativo->observaciones = $request->observaciones;

    $admnistrativo->save();

    return redirect()
        ->route('listadoUsuarios', [
            'rol' => 'admnistrativo',
            'id' => $admnistrativo->id
        ])
        ->with('success', 'Admnistrativo actualizado correctamente');
}

}
