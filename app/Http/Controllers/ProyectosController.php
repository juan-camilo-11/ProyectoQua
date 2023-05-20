<?php

namespace App\Http\Controllers;

use App\Models\Proyectos;
use App\Models\proyectos_tienen_usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Obtenemos el usuario autenticado
        $proyectos = Proyectos::whereHas('usuarios', function ($query) use ($user) {
            $query->where('usuario_id', $user->id);
        })->with(['usuarios' => function ($query) use ($user) {
            $query->where('usuario_id', $user->id)->select('cargo_id');
        }])->orderBy('nombre')->paginate(10);
        //dd($proyectos);
        return view('proyectos.index', ['proyectos' => $proyectos]);
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
        DB::beginTransaction(); // Iniciar la transacción a la base de datos
        try {
            // Validar informacion del formulario
            $request->validate([
                'nombre' => 'required|min:3|unique:proyectos',
                'objetivo' => 'required|min:3',
            ]);
            // Guardar informacion del formulario
            $proyecto = new proyectos;
            $proyecto->nombre = $request->nombre;
            $proyecto->objetivo = $request->objetivo;
            $proyecto->save();
            $usuario_id = $request->usuario_id;
            $cargo_id = "Scrum Master";
            $this->llamarStoreDeProyectos_tiene_usuarios($proyecto->id,$usuario_id,$cargo_id);

            DB::commit(); // Si todo sale bien, se confirma la operacion

            return redirect()->route('proyectos.index')->with('success','Proyecto creado con éxito');
        } catch (\Exception $e) {
            DB::rollBack(); // Si sale algo mal, se revierte y no se registra nada
            return redirect()->route('proyectos.index')->with('error','Error al crear el proyecto: '.$e->getMessage());
        }
    }

    public function llamarStoreDeProyectos_tiene_usuarios($proyecto_id,$usuario_id,$cargo_id)
    {
        $proyectosController = App::make(proyectos_tiene_usuarios::class);
        $proyectosController->store($proyecto_id, $usuario_id,$cargo_id);
    }
    public function agregarMiembroProyecto(Request $request){
        DB::beginTransaction(); // Iniciar la transacción a la base de datos
        try {
            // Validar informacion del formulario
            $request->validate([
                'correo' => 'required|min:3|email|exists:users,email',
                'cargo_id' => 'required|min:3',
            ]);
            // Obtener id del usuario
            $correo = $request->correo;
            $usuario = User::where('email', $correo)->firstOrFail();
            $usuario_id = $usuario->id;

            // Obtener proyecto
            $proyecto = Proyectos::findOrFail($request->proyecto_id);

            // Validar si el usuario ya existe en relacion al proyecto
            if ($proyecto->usuarios->contains('id', $usuario_id)) {
                throw new \Exception('El usuario ya está asociado al proyecto');
            }
            
            $this->llamarStoreDeProyectos_tiene_usuarios($request->proyecto_id,$usuario_id,$request->cargo_id);

            DB::commit(); // Si todo sale bien, se confirma la operacion

            return redirect()->route('proyectos.show', $request->proyecto_id)->with('success','Miembro agregado correctamente');
        } catch (\Exception $e) {
            DB::rollBack(); // Si sale algo mal, se revierte y no se registra nada
            return redirect()->route('proyectos.show', $request->proyecto_id)->with('error','Error al agregar un miembro: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $proyecto = Proyectos::find($id);
        $proyecto = Proyectos::with('usuarios')->findOrFail($id);
        $usuarios = $proyecto->usuarios;
        // Usuario Autenticado
        $usuarioAutenticado = Auth::user();
        $cargo = "";
        foreach ($usuarios as $usuario) { // Iteramos los usuarios
            if ($usuario->id === $usuarioAutenticado->id) { // Validamos cual es el usuario con id igual al usuario autenticado
                $pivot = proyectos_tienen_usuarios::where('proyecto_id', $id)
                    ->where('usuario_id', $usuarioAutenticado->id)
                    ->first(); // tomamon el que el id del proyecto sea igual, y el id de usuario sea igual al usuario autenticado
                $cargo = $pivot->cargo_id; // Guardamos el cargo
                break;
            }
        }
        return view('proyectos.show', ['proyecto' => $proyecto, 'usuarios' => $usuarios, 'cargo' => $cargo]);

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
