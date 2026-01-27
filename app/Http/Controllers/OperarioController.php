<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Operario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Validator;

class OperarioController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'rol' => 'required|in:gestor,administrativo,operario'
        ]);

        $credentials = $request->except(['_token']);

        $rol = $credentials['rol'];

        switch ($rol) {
            case 'gestor':
                if (Auth::guard('gestor')->attempt($credentials)) {

                    return redirect()->route('admin');

                } else {
                    session()->flash('message', 'Invalid credentials');
                    return redirect()->back();
                }
                break;
            case 'administrativo':
                if (Auth::guard('administrativo')->attempt($credentials)) {
                    return redirect()->route('administrativo');
                } else {
                    session()->flash('message', 'Invalid credentials');
                    return redirect()->back();
                }
                break;
            case 'operario':
                if (Auth::guard('operario')->attempt($credentials)) {

                    return redirect()->route('operario');
                } else {
                    session()->flash('message', 'Invalid credentials');
                    return redirect()->back();
                }
                break;

        }

        //dd(Auth::guard('operario')->attempt($credentials));

        if (Auth::guard('operario')->attempt($credentials)) {  //comprobación de autenticación

            return redirect()->route('admin');  //nos redirije a la ruta 'admin'

        } else {
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = Operario::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('admin');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
