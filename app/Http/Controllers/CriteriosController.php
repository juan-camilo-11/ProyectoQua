<?php

namespace App\Http\Controllers;

use App\Models\Criterios;
use App\Models\Proyectos;
use Illuminate\Http\Request;

class CriteriosController extends Controller
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
            $criterios = $proyecto->criterios;
            return view('criterios.index', ['criterios' => $criterios]);
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
        {
            //DB::beginTransaction(); // Iniciar la transacción a la base de datos
            try {
                $requestData = $request->except(['_token', 'proyecto_id']);
                // Validamos al menos una seleccion
                if (empty($requestData)) {
                    throw new \Exception("No hay ninguna selecionada, intentalo otra vez");
                }
                // Validamos las ponderaciones

                // Verificar si la longitud del array es mayor que cero
                if (in_array(null, $requestData)) {
                    // Al menos un valor es nulo
                    throw new \Exception("No puedes dejar vacia la ponderacion, si no la requieres ponlos en 0");
                } else {
                    // Todos los valores son diferentes de nulo
                    // Se filtran las ponderaciones, para poder validarlas
                    $ponderaciones = array_filter($requestData, function ($key) {
                        return strpos($key, 'p_') === 0;
                    }, ARRAY_FILTER_USE_KEY);

                    $valores = array_values($ponderaciones); // Tomamos los valores 

                    $suma = array_sum($valores); // Sumamos los valores
                    if ($suma > 100) {
                        throw new \Exception("Los valores son superiores a 100");
                    }
                }


                $proyecto_id = decrypt($request->proyecto_id); // Desciframos el id del proyecto
                // Validar informacion del formulario
                
                $request->validate([
                    'c_funcionalidad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_eficiencia' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_compatibilidad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_usabilidad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_fiabilidad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_seguridad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_mantenibilidad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                    'c_portabilidad' => 'sometimes|required|unique:criterios,Nombre,NULL,id,proyecto_id,'.$proyecto_id,
                ]);
                $request->validate([
                    'c_funcionalidad' => 'sometimes|required_without_all:c_eficiencia,c_compatibilidad,c_usabilidad,c_fiabilidad,c_seguridad,c_mantenibilidad,c_portabilidad',
                    'p_funcionalidad' => 'required_if:c_funcionalidad,on|integer|min:0|max:100',
                    'c_eficiencia' => 'sometimes|required_without_all:c_funcionalidad,c_compatibilidad,c_usabilidad,c_fiabilidad,c_seguridad,c_mantenibilidad,c_portabilidad',
                    'p_eficiencia' => 'required_if:c_eficiencia,on|integer|min:0|max:100',
                    'c_compatibilidad' => 'sometimes|required_without_all:c_funcionalidad,c_eficiencia,c_usabilidad,c_fiabilidad,c_seguridad,c_mantenibilidad,c_portabilidad',
                    'p_compatibilidad' => 'required_if:c_compatibilidad,on|integer|min:0|max:100',
                    'c_usabilidad' => 'sometimes|required_without_all:c_funcionalidad,c_eficiencia,c_compatibilidad,c_fiabilidad,c_seguridad,c_mantenibilidad,c_portabilidad',
                    'p_usabilidad' => 'required_if:c_usabilidad,on|integer|min:0|max:100',
                    'c_fiabilidad' => 'sometimes|required_without_all:c_funcionalidad,c_eficiencia,c_compatibilidad,c_usabilidad,c_seguridad,c_mantenibilidad,c_portabilidad',
                    'p_fiabilidad' => 'required_if:c_fiabilidad,on|integer|min:0|max:100',
                    'c_seguridad' => 'sometimes|required_without_all:c_funcionalidad,c_eficiencia,c_compatibilidad,c_usabilidad,c_fiabilidad,c_mantenibilidad,c_portabilidad',
                    'p_seguridad' => 'required_if:c_seguridad,on|integer|min:0|max:100',
                    'c_mantenibilidad' => 'sometimes|required_without_all:c_funcionalidad,c_eficiencia,c_compatibilidad,c_usabilidad,c_fiabilidad,c_seguridad,c_portabilidad',
                    'p_mantenibilidad' => 'required_if:c_mantenibilidad,on|integer|min:0|max:100',
                    'c_portabilidad' => 'sometimes|required_without_all:c_funcionalidad,c_eficiencia,c_compatibilidad,c_usabilidad,c_fiabilidad,c_seguridad,c_mantenibilidad',
                    'p_portabilidad' => 'required_if:c_portabilidad,on|integer|min:0|max:100',
                ]);
                

                // Guardar informacion del formulario
                // Verificar si el campo c_funcionalidad está presente en la solicitud
                if ($request->has('c_funcionalidad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'funcionalidad';
                    $criterio->ponderacion = $request->input('p_funcionalidad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_eficiencia está presente en la solicitud
                if ($request->has('c_eficiencia')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'eficiencia';
                    $criterio->ponderacion = $request->input('p_eficiencia');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_compatibilidad está presente en la solicitud
                if ($request->has('c_compatibilidad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'compatibilidad';
                    $criterio->ponderacion = $request->input('p_compatibilidad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_usabilidad está presente en la solicitud
                if ($request->has('c_usabilidad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'usabilidad';
                    $criterio->ponderacion = $request->input('p_usabilidad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_fiabilidad está presente en la solicitud
                if ($request->has('c_fiabilidad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'Fiabilidad';
                    $criterio->ponderacion = $request->input('p_fiabilidad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_seguridad está presente en la solicitud
                if ($request->has('c_seguridad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'seguridad';
                    $criterio->ponderacion = $request->input('p_seguridad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_mantenibilidad está presente en la solicitud
                if ($request->has('c_mantenibilidad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'mantenibilidad';
                    $criterio->ponderacion = $request->input('p_mantenibilidad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }

                // Verificar si el campo c_portabilidad está presente en la solicitud
                if ($request->has('c_portabilidad')) {
                    $criterio = new Criterios;
                    $criterio->nombre = 'portabilidad';
                    $criterio->ponderacion = $request->input('p_portabilidad');
                    $criterio->proyecto_id = $proyecto_id;
                    $criterio->save();
                }



                //DB::commit(); // Si todo sale bien, se confirma la operacion

                return redirect()->route('proyectos.show', ['proyecto' => $proyecto_id])->with('success', 'Criterios asignados con exito');
            } catch (\Exception $e) {
                //DB::rollBack(); // Si sale algo mal, se revierte y no se registra nada
                $proyecto_id = decrypt($request->proyecto_id); // Desciframos el id del proyecto
                return redirect()->route('proyectos.show', ['proyecto' => $proyecto_id])->with('error', 'Error al asignar criterios: ' . $e->getMessage());
            }
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $criterio = Criterios::find($id);
        $criterio->delete();
        return redirect()->back()->with('success', 'El criterio ha sido eliminado correctamente.');
    }
}
