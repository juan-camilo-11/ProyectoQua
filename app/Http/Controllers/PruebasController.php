<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Pruebas;
use App\Models\RequisitosFuncionales;

class PruebasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        try {
            $id = decrypt($_REQUEST['proyecto']);
            $proyecto = Proyectos::findOrFail($id);
            $criterios = $proyecto->criterios; // Obtenemos los criterios asociados al proyecto
            // Obtenemos los IDs de los criterios del proyecto
            $criterios_id = [];
            foreach (json_decode($criterios, true) as $criterio) {
                $criterios_id[] = $criterio['id'];
            }
            // Obtenemos los requisitos funcionales y las pruebas que pertenecen a los criterios del proyecto
            $requisitos = RequisitosFuncionales::whereIn('criterio_id', $criterios_id)->with('pruebas')->paginate(10);

            return view('pruebas.index', ['criterios' => $criterios],['requisitos' => $requisitos]);
        } catch (\Exception $e) {
            return redirect()->route('pruebas.index')->with('error', 'Error: ' . $e->getMessage());
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
            // Validar informacion del formulario
            $request->validate([
                'descripcion' => 'required|min:10',
                'pasos' => 'required|min:10',
                'resultadoEsperado' => 'required|min:10',
                'prioridad' => 'required',
                'fechaEntrega' => 'required',
                'requisito_id' => 'required|',
            ]);
            // Guardar informacion del formulario
            $prueba = new Pruebas;
            $prueba->descripcion = $request->descripcion;
            $prueba->pasos = $request->pasos;
            $prueba->resultadoEsperado = $request->resultadoEsperado;
            $prueba->prioridad = $request->prioridad;
            $prueba->fechaEntrega = $request->fechaEntrega;
            $prueba->requisito_id = $request->requisito_id;
            $prueba->save();

            return redirect()->back()->with('success','Prueba asiganda con exito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Error al asignar prueba: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $prueba = Pruebas::find($id);
        return view('pruebas.show', ['prueba' => $prueba]);
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
            $prueba = Pruebas::findOrFail($id);
            $prueba->descripcion = $request->descripcion;
            $prueba->pasos = $request->pasos;
            $prueba->resultadoEsperado = $request->resultadoEsperado;
            $prueba->prioridad = $request->prioridad;
            $prueba->fechaEntrega = $request->fechaEntrega;
            $prueba->requisito_id = $request->requisito_id;
            $prueba->save();
            return redirect()->back()->with('success', 'Pruebas actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la prueba: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $prueba = Pruebas::findOrFail($id);
            $prueba->delete();
            return redirect()->back()->with('success', 'Prueba eliminado exitosamente.');
        } catch (\Throwable $th) {
            return back()->withErrors(['Error al eliminar la prueba.']);
        }
    }
}
