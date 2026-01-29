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

        $administrativo = Administrativo::findOrFail($id);

        $administrativo->name = $request->name;
        $administrativo->email = $request->email;
        $administrativo->save();

        return redirect()
            ->route('listadoUsuarios', [
                'rol' => 'administrativo',
                'id' => $administrativo->id
            ])
            ->with('success', 'Administrativo actualizado correctamente');
    }
}
