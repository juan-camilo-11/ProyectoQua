<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Pruebas;
use App\Models\RequisitosFuncionales;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $pruebas = collect();  // Creamos una colecion para guardar las pruebas de este proyecto
            $id = decrypt($_REQUEST['proyecto']); // Obtener el id del proyecto
            $proyecto = Proyectos::findOrFail($id); // Buscamos el proyecto
            $results = DB::select('CALL obtener_progreso_del_proyecto(?)', [$proyecto->id]);// Lammamos el procedimiento almacenado que devuelve la proyecto el progreso por criterio
            $criteriosIds = collect($results)->pluck('id'); // Obtener los IDs de los criterios
            $requisitos = RequisitosFuncionales::whereIn('criterio_id', $criteriosIds)->get(); // Obtener los requisitos relacionados
            foreach ($requisitos as $requisito) { // Iteramos por los requisitos funcionales para traer las pruebas
                $pruebasPorRequisito = Pruebas::where('requisito_id', $requisito->id)
                    ->select('id', 'codigo', 'estado', 'prioridad')
                    ->get();
                    $pruebas = $pruebas->concat($pruebasPorRequisito); // Concatenar las pruebas a la colección principal
            }
           return view('seguimiento.index', ['proyecto' => $proyecto,'results' => $results, 'pruebas' => $pruebas]);
        } catch (\Exception $e) {
            return redirect()->route('seguimiento.index')->with('error', 'Error: ' . $e->getMessage());
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}