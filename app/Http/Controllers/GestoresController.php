<?php

namespace App\Http\Controllers;

use App\Models\Gestor;
use Illuminate\Http\Request;

class GestoresController extends Controller
{
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        $gestor = Gestor::findOrFail($id);

        $gestor->name = $request->name;
        $gestor->email = $request->email;
        $gestor->save();

        return redirect()
            ->route('listadoUsuarios', [
                'rol' => 'gestor',
                'id' => $gestor->id
            ])
            ->with('success', 'Gestor actualizado correctamente');
    }
}
