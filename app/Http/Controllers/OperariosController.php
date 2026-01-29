<?php

namespace App\Http\Controllers;

use App\Models\Operario;
use Illuminate\Http\Request;

class OperariosController extends Controller
{
     public function update(Request $request, $id)
    {

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        $gestor = Operario::findOrFail($id);

        $gestor->name = $request->name;
        $gestor->email = $request->email;
        $gestor->save();

        return redirect()
            ->route('listadoUsuarios', [
                'rol' => 'operario',
                'id' => $gestor->id
            ])
            ->with('success', 'Operario actualizado correctamente');
    }
}
