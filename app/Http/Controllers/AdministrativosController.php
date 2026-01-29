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

        $gestor = Administrativo::findOrFail($id);

        $gestor->name = $request->name;
        $gestor->email = $request->email;
        $gestor->save();

        return redirect()
            ->route('listadoUsuarios', [
                'rol' => 'administrativo',
                'id' => $gestor->id
            ])
            ->with('success', 'Administrativo actualizado correctamente');
    }
}
