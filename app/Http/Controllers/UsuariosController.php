<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $usuarios = User::paginate(10);
        //Filtro
        if($request->atributo != null){
            $artributo = strtolower($request->atributo);
            $usuarios = User::where(function ($query) use ($artributo) {
                $query->whereRaw('LOWER(nombre) like ?', ["%$artributo%"])
                    ->orWhereRaw('LOWER(apellido) like ?', ["%$artributo%"])
                    ->orWhereRaw('LOWER(email) like ?', ["%$artributo%"]);
            })->paginate(10);
        }
        return view('usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $usuario = User::find($id);
        return view('usuarios.show', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $usuario = User::findOrFail($id);
            $usuario->nombre = $request->nombre;
            $usuario->apellido = $request->apellido;
            $usuario->telefono = $request->telefono;
            $usuario->email = $request->email;
            $usuario->estado = $request->estado;
            $usuario->save();
            return redirect()->back()->with('success', 'Datos actualizados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar datos: ' . $e->getMessage());
        }
    }

    public function cambiarContrasena(Request $request)
    {
        try{
        $userID = Auth::user()->id;
        $user = User::find($userID);
        $request->validate([
            'password_actual' => 'required',
            'password_nueva' => 'required|min:8|confirmed',
        ]);

        // Verificar si la contraseña actual coincide
        if (Hash::check($request->password_actual, $user->password)) {
            // Actualizar la contraseña
            $password_nueva = Hash::make($request->password_nueva);
            $user->password = $password_nueva;
            $user->save();
            return redirect()->route('usuarios.show',Auth::user()->id)->with('success', 'Contraseña cambiada exitosamente.');
        }
        throw new \Exception();
        }
        catch (\Exception $e) {
            return redirect()->route('usuarios.show',Auth::user()->id)->with('error', 'Error al intentar cambiar la contraseña'. $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
