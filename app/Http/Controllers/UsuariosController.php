<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Administrativo;
use App\Models\Gestor;
use App\Models\Operario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Validator;

class UsuariosController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'rol' => 'required|in:gestor,administrativo,operario'
        ]);

        $credentials = $request->only('email', 'password');
        $rol = $request->rol;

        switch ($rol) {
            case 'gestor':
                if (Auth::guard('gestor')->attempt($credentials)) {
                    return redirect()->route('admin');
                }
                break;

            case 'administrativo':
                if (Auth::guard('administrativo')->attempt($credentials)) {
                    return redirect()->route('administrativo');
                }
                break;

            case 'operario':
                if (Auth::guard('operario')->attempt($credentials)) {
                    return redirect()->route('operario');
                }
                break;
        }

        return back()->with('message', 'Invalid credentials');
    }


    /*IMPORTANTE: Puede que la función "auth()->attempt($credentials)" de problemas,por tanto, otra forma es cambiarla por:

            Auth::attempt($credentials)

y añadir la función al modelo Estudiante

            public function getAuthPassword(){
                return $this->password;
            }

*/

    public function registro(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'rol' => 'required|in:gestor,administrativo,operario'
        ]);



        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        //dd($request->rol);


        switch ($request->rol) {
            case 'gestor':
                Gestor::create($data);
                return redirect()->route('listadoUsuarios')->with('success', 'Gestor creado correctamente');

            case 'administrativo':
                Administrativo::create($data);
                return redirect()->route('listadoUsuarios')->with('success', 'Administrativo creado correctamente');

            case 'operario':
                Operario::create($data);
                return redirect()->route('listadoUsuarios')->with('success', 'Operario creado correctamente');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function listadoUsuarios(){

        $gestores = Gestor::All();
        $administrativos = Administrativo::All();
        $operarios = Operario::All();

        return view('listadoUsuarios', compact('gestores', 'administrativos', 'operarios'));

    }
}
