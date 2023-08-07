<?php

namespace App\Exports;

use App\Models\Proyectos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class ProyectoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
     /*   $requisitos = new Collection();
        $pruebas = new Collection();
        $evaluaciones = new Collection();
        $proyecto = Proyectos::where('id', $this->id)->first(); // Obtenemos el proyecto
        $criterios = $proyecto->criterios; // Obtenemos los c riterios del proyecto
        foreach ($criterios as $criterio){
            $requisitos = $requisitos->concat($criterio->requisitosFuncionales);
        }
        foreach ($requisitos as $requisito){
            $pruebas = $pruebas->concat($requisito->pruebas);
        }
        foreach ($pruebas as $prueba){
            $evaluaciones = $evaluaciones->concat($prueba->evaluacion);
        }
        dd($evaluaciones);
        */
        $proyecto = Proyectos::where('id', $this->id)->with('criterios.requisitosFuncionales.pruebas.evaluacion')->first();
        return view('exportProyects', [
            'proyecto' => $proyecto
        ]);
    }
}
