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
                $request->session()->regenerate();
                return redirect()->route('listadoUsuarios');
            }
            break;

        case 'administrativo':
            if (Auth::guard('administrativo')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('administrativo');
            }
            break;

        case 'operario':
            if (Auth::guard('operario')->attempt($credentials)) {
                $request->session()->regenerate();
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
        'apellidos' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'rol' => 'required|in:gestor,administrativo,operario'
    ]);

    $data = [
        'name' => $request->name,
        'apellidos' => $request->apellidos,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'observaciones' => $request->observaciones,
        'rol' => $request->rol,
        'password' => Hash::make($request->password),
        'imagen' => $request->imagen
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
        foreach (['gestor', 'administrativo', 'operario'] as $guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }



    public function listadoUsuarios(Request $request)
    {

        $gestores = Gestor::All();
        $administrativos = Administrativo::All();
        $operarios = Operario::All();

        $usuarioSeleccionado = null;
        $rol = $request->rol;

        if ($rol && $request->id) {
            switch ($rol) {
                case 'gestor':
                    $usuarioSeleccionado = Gestor::find($request->id);
                    break;
                case 'administrativo':
                    $usuarioSeleccionado = Administrativo::find($request->id);
                    break;
                case 'operario':
                    $usuarioSeleccionado = Operario::find($request->id);
                    break;
            }
        }

        return view('listadoUsuarios', compact('gestores', 'administrativos', 'operarios', 'usuarioSeleccionado', 'rol'));
    }

    public function usuarioActual(Request $request)
    {
        $guards = ['gestor', 'administrativo', 'operario'];
        $usuario = null;
        $rol = null;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $usuario = Auth::guard($guard)->user();
                $rol = $guard;
            }
        }

        return response()->json(
            $usuario ? ['usuario' => $usuario, 'rol' => $rol] : ['usuario' => null, 'rol' => null],
            $usuario ? 200 : 401
        );
    }
}
