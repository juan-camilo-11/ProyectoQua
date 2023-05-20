<?php

namespace App\Http\Controllers;

use App\Models\Evaluaciones;
use App\Models\Pruebas;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            // Validar informacion del formulario
            $request->validate([
                'observacion' => '',
                'resultadoObtenido' => 'required',
                'prueba_id' => 'required',
            ]);
            // Guardar informacion del formulario
            $evaluacion = new Evaluaciones;
            $evaluacion->observacion = $request->observacion;
            $evaluacion->resultadoObtenido = $request->resultadoObtenido;
            $evaluacion->prueba_id = $request->prueba_id;
            $evaluacion->save();
            $this->actualizarEstadoPrueba($request->prueba_id, $request->estado);

            return redirect()->back()->with('success','Evaluacion registrada con exito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Error al registrar evaluacion: '.$e->getMessage());
        }
    }
    public function actualizarEstadoPrueba($idPrueba, $nuevoEstado)
    {
        $prueba = Pruebas::find($idPrueba);
        $prueba->estado = $nuevoEstado;
        $prueba->save();
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
