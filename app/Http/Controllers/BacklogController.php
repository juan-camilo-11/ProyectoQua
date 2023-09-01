<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use Illuminate\Http\Request;
use App\Models\Proyectos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BacklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = decrypt($_REQUEST['proyecto']); // Obtener el id del proyecto
        
        $proyecto_p = Proyectos::where('id', $id)->with('criterios.requisitosFuncionales');
   
        $diasRestantes = DB::select('CALL CalcularDiasRestantes(?, @dias_restantes)', [$id]);
        $diasRestantes = DB::select('SELECT @dias_restantes as dias_restantes')[0]->dias_restantes;

        $proyecto_p = $proyecto_p->first();
      
        $requisitos =  $proyecto_p->criterios->flatMap(function ($criterio) {
            return $criterio->requisitosFuncionales;
        });
        return view('scrum.backlog', ['requisitos' => $requisitos, 'diasRestantes' => $diasRestantes]);
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
        
        $datos = $request->json()->all();
        $id = 0;
        foreach ($datos as $item) {
            $id = decrypt($item['proyectoId']);
        }
        $registros = Backlog::where('proyecto_id', $id)->get();   
        if(!$registros->isEmpty()){
            Backlog::where('proyecto_id', $id)->delete();
        }
        // Aquí puedes trabajar con los datos recibidos, como almacenarlos en la base de datos, realizar cálculos, etc.
        
        foreach ($datos as $item) {
       
            $dia = $item['dia'];
            $proyectoId = decrypt($item['proyectoId']);
            $elementos = $item['elementos'];
            

            foreach ($elementos as $elemento) {
                // Asegúrate de ajustar los campos y los valores según tu estructura de datos
                Backlog::create([
                    'dia' => $dia,
                    'requisito_id' => $elemento['requisitoId'],
                    'proyecto_id' => $proyectoId,
                ]);
            }
        }
       return response()->json(['mensaje' => 'temos melos']);
      // return redirect()->route('proyectos.show', $proyectoId);
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
