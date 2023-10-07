<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\RequisitosFuncionales;

class ReqFuncionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $id = decrypt($_REQUEST['proyecto']);
            $proyecto = Proyectos::findOrFail($id);
            $criterios = $proyecto->criterios; // Obtenemos los criterios asociados al proyecto
            $usuarios = $proyecto->usuarios; // Obtenemos los usuarios asociados al proyecto
            $criterios_id = [];
            foreach(json_decode($criterios, true) as $criterio) { // Guardamos los id
                $criterios_id[] = $criterio['id'];
            }
            
            $requisitos = RequisitosFuncionales::whereIn('criterio_id', $criterios_id)->paginate(5); // Obtenemos losrequisitos con criterio_id sea igual a los criterios asociados al proyecto
             
            
            return view('requisitos.index', ['criterios' => $criterios, 'requisitos' => $requisitos, 'usuarios' => $usuarios]);
        } catch (\Exception $e) {
            return redirect()->route('proyectos.index')->with('error', 'Error: ' . $e->getMessage());
        }
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
        try {
            // Validamos el estado del proyecto 
            $proyecto = Proyectos::find($request->proyecto_id);
                if ($proyecto->estado != 'Activo'){
                    throw new \Exception("Este proyecto ya no esta disponible. Estado: ".$proyecto->estado);
            }
            // Validar informacion del formulario
            $request->validate([
                'nombre' => 'required|min:3',
                'criterio_id' => 'required',
            ]);
            // Guardar informacion del formulario
            $requisito = new RequisitosFuncionales;
            $requisito->nombre = $request->nombre;
            $requisito->criterio_id = $request->criterio_id;
            $requisito->save();

            return redirect()->back()->with('success','Proyecto creado con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Error al crear el proyecto: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            $requisito = RequisitosFuncionales::findOrFail($id);
            $requisito->Nombre = $request->nombre;
            $requisito->criterio_id = $request->criterio_id;
            $requisito->save();
            return redirect()->back()->with('success', 'Requisito actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el requisito: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $requisito = RequisitosFuncionales::findOrFail($id);
            $requisito->delete();
            return redirect()->back()->with('success', 'Requisito eliminado exitosamente.');
        } catch (\Throwable $th) {
            return back()->withErrors(['Error al eliminar el requisito.']);
        }
    }
}
