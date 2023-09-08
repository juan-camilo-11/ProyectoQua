<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Criterios;
use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Pruebas;
use App\Models\RequisitosFuncionales;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
           return view('reportes.index', ['proyecto' => $proyecto,'results' => $results, 'pruebas' => $pruebas]);
        } catch (\Exception $e) {
            return redirect()->route('reportes.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function scrum()
    {
        //
        try {
            $id = decrypt($_REQUEST['proyecto']); // Obtener el id del proyecto
            $registros = Backlog::where('proyecto_id', $id)->get();
          
            foreach ($registros as $registro){
                $requisito = RequisitosFuncionales::find($registro->requisito_id);
                $registro->requisito = $requisito; // Agregar el requisito al registro

            }
           
           return view('seguimiento.index',['registros'=>$registros]);
        } catch (\Exception $e) {
            $id = decrypt($_REQUEST['proyecto']); // Obtener el id del proyecto
            return redirect()->route('proyectos.show', $id);
        }
    }
    /**
     * Metodo para pdf
     */
    public function prueba($Id)
    {
        //
        try {
            $pruebas = collect();  // Creamos una colecion para guardar las pruebas de este proyecto
            $id = decrypt($Id); // Obtener el id del proyecto
            $proyecto = Proyectos::findOrFail($id); // Buscamos el proyecto
            $criterios = Criterios::where('proyecto_id', $id)->get(); // Consultos los criterios

            $results = DB::select('CALL obtener_progreso_del_proyecto(?)', [$proyecto->id]);// Lammamos el procedimiento almacenado que devuelve la proyecto el progreso por criterio
            $criteriosIds = collect($results)->pluck('id'); // Obtener los IDs de los criterios
            $criterios = Criterios::whereIn('id', $criteriosIds)->get();
            $requisitos = RequisitosFuncionales::whereIn('criterio_id', $criteriosIds)->get(); // Obtener los requisitos relacionados
            foreach ($requisitos as $requisito) { // Iteramos por los requisitos funcionales para traer las pruebas
                $pruebasPorRequisito = Pruebas::where('requisito_id', $requisito->id)
                    
                    ->get();
                    $pruebas = $pruebas->concat($pruebasPorRequisito); // Concatenar las pruebas a la colección principal
            }
           
            $pdf = FacadePdf::loadView('reportes.pdf',
            [
                'proyecto' => $proyecto,
                'results' => $results, 
                'requisitos' => $requisitos,
                'criterios' => $criterios,
                'pruebas' => $pruebas
            ]);
            return $pdf->stream('reporte.pdf');
        } catch (\Exception $e) {

            return redirect()->route('proyectos.show', $id);
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
