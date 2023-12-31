<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Pruebas;
use App\Models\Daily;
use App\Models\RequisitosFuncionales;

class PruebasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        //
        try {
            $id = decrypt($_REQUEST['proyecto']);
            //$id = decrypt($request->input('proyecto'));
            $proyecto = Proyectos::findOrFail($id);
            $usuarios = $proyecto->usuarios;


            $proyecto_p = Proyectos::where('id', $id)->with('criterios.requisitosFuncionales.pruebas.evaluacion');

            $proyecto_p = $proyecto_p->first();
            $requisitos =  $proyecto_p->criterios->flatMap(function ($criterio) {
                return $criterio->requisitosFuncionales;
            });
            $pruebas =  $proyecto_p->criterios->flatMap(function ($criterio) {
                return $criterio->requisitosFuncionales->flatMap(function ($requisito) {
                    return $requisito->pruebas;
                });
            });

            // Filtros
            if ($request->codigo !== null) {
                $codigo = $request->codigo;
                $pruebas = $pruebas->filter(function ($prueba) use ($codigo) {
                    return str_contains($prueba->codigo, $codigo);
                });
            }
            if ($request->estado !== null) {
                $estado = $request->estado;
                $pruebas = $pruebas->filter(function ($prueba) use ($estado) {
                    return $prueba->estado === $estado;
                });
            }
            if ($request->prioridad !== null) {
                $prioridad = $request->prioridad;
                $pruebas = $pruebas->filter(function ($prueba) use ($prioridad) {
                    return $prueba->prioridad === $prioridad;
                });
            }
            if ($request->tipo !== null) {
                $tipo = $request->tipo;
                $pruebas = $pruebas->filter(function ($prueba) use ($tipo) {
                    return $prueba->Tipo === $tipo;
                });
            }
            if ($request->fechaEntrega !== null) {
                $fechaEntrega = $request->fechaEntrega;
                $pruebas = $pruebas->filter(function ($prueba) use ($fechaEntrega) {
                    return $prueba->fechaEntrega === $fechaEntrega;
                });
            }
            if ($request->responsable !== null) {
                $responsable = $request->responsable;
                $pruebas = $pruebas->filter(function ($prueba) use ($responsable) {

                    return $prueba->usuario_id == $responsable;
                });
            }



            return view('pruebas.index', ['pruebas' => $pruebas, 'usuarios' => $usuarios, 'requisitos' => $requisitos]);
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
            // Validamos el estado del proyecto 
            $proyecto = Proyectos::find($request->id);
            if ($proyecto->estado != 'Activo'){
                    throw new \Exception("Este proyecto ya no esta disponible. Estado: ".$proyecto->estado);
            }
            $id = $request->id;
            $proyecto_p = Proyectos::where('id', $id)->with('criterios.requisitosFuncionales.pruebas')->first();


            $pruebas =  $proyecto_p->criterios->flatMap(function ($criterio) {
                return $criterio->requisitosFuncionales->flatMap(function ($requisito) {
                    return $requisito->pruebas;
                });
            });
            foreach ($pruebas as $prueba) {
                if ($prueba->codigo == $request->codigo) {
                    throw new \Exception("Codigo ya existente");
                }
            }
            // Validar el numero de pruebas para el usuario por dia

            // Verifica cuántas pruebas existen para el responsable en la fecha dada.
            $count = Pruebas::where('usuario_id', $request->usuario_id)
            ->whereDate('fechaEntrega', $request->fechaEntrega)
            ->count();
            if ($count > 4){
                throw new \Exception("Este usuario ya tiene 5 pruebas asignadas para esta fecha");
            }

            // Validar informacion del formulario
            $request->validate([
                'tipo' => 'required',
                'descripcion' => 'required|min:10',
                'pasos' => 'required|min:10',
                'codigo' => 'required|min:4',
                'resultadoEsperado' => 'required|min:10',
                'prioridad' => 'required',
                'fechaEntrega' => 'required',
                'requisito_id' => 'required|',
                'usuario_id' => 'required|',
            ]);
            // Guardar informacion del formulario
            $prueba = new Pruebas;
            $prueba->tipo = $request->tipo;
            $prueba->descripcion = $request->descripcion;
            $prueba->pasos = $request->pasos;
            $prueba->codigo = $request->codigo;
            $prueba->resultadoEsperado = $request->resultadoEsperado;
            $prueba->prioridad = $request->prioridad;
            $prueba->fechaEntrega = $request->fechaEntrega;
            $prueba->requisito_id = $request->requisito_id;
            $prueba->usuario_id = $request->usuario_id;
            $prueba->save();
            $daily = new Daily;
            $daily->fecha = $request->fechaEntrega;
            $daily->codigo = $request->codigo;
            $daily->estado = 'En espera';
            $daily->prueba_id = $prueba->id;
            $daily->proyecto_id = $id;
            $daily->save();
            return redirect()->back()->with('success', 'Prueba asiganda con exito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al asignar prueba: ' . $e->getMessage());
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
            $prueba->Tipo = $request->tipo;
            $prueba->resultadoEsperado = $request->resultadoEsperado;
            $prueba->prioridad = $request->prioridad;
            $prueba->fechaEntrega = $request->fechaEntrega;
            $prueba->requisito_id = $request->requisito_id;
            $prueba->save();
            $daily = Daily::where('prueba_id', $id)->first();
            if ($daily) {
                $daily->codigo = $request->codigo;
                $daily->save();
            }
            return redirect()->back()->with('success', 'Pruebas actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la prueba: ' . $e->getMessage());
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
            // Buscar y eliminar el registro correspondiente en la tabla "Daily"
            Daily::where('prueba_id', $id)->delete();
            return redirect()->back()->with('success', 'Prueba eliminado exitosamente.');
        } catch (\Throwable $th) {
            return back()->withErrors(['Error al eliminar la prueba.']);
        }
    }
}
