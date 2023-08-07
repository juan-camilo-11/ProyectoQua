<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mensaje = $this->mostrarMensaje();
        $usuarioId = Auth::user()->id;
        $usuario = User::find($usuarioId);
        $proyectos = $usuario->proyectos()->paginate(5);
        foreach ($proyectos as $proyecto) {
            $idProyecto = $proyecto->id;
            $proyecto->avance = $this->avanceDelProyecto($idProyecto);
        }
        // Pruebas no aprobadas en las ultimas 24 horas
        $resultadoPruebaNo = DB::select('CALL ObtenerPruebasNo(?)', [$usuarioId]);
        $PruebasNoAprobadas = $resultadoPruebaNo[0]->{'count(*)'};
        // Pruebas aprobadas en las ultimas 24 horas
        $resultadoPruebaA = DB::select('CALL ObtenerPruebasAprobadas(?)', [$usuarioId]);
        $PruebasAprobadas = $resultadoPruebaA[0]->{'count(*)'};
        // Pruebas aprobadas en las ultimas 24 horas
        $resultadoPruebaAs = DB::select('CALL ObtenerPruebasAsignadas(?)', [$usuarioId]);
        $PruebasAsignadas = $resultadoPruebaAs[0]->{'count(*)'};
        return view('dashboard', [
            'mensaje' => $mensaje,
            'proyectos' => $proyectos,
            'PruebasNoAprobadas' => $PruebasNoAprobadas,
            'PruebasAprobadas' => $PruebasAprobadas,
            'PruebasAsignadas' => $PruebasAsignadas,
        ]);        
    }

    public function mostrarMensaje()
    {
        $horaActual = Carbon::now();
        $horaLimiteManana = Carbon::createFromTime(12, 0, 0); // 12:00:00
        $horaLimiteTarde = Carbon::createFromTime(18, 0, 0); // 18:00:00
        $horaLimiteNoche = Carbon::createFromTime(0, 0, 0); // 00:00:00

        if ($horaActual->lessThan($horaLimiteManana)) {
            $mensajeSaludo = 'Buenos días';
        } elseif ($horaActual->lessThan($horaLimiteTarde)) {
            $mensajeSaludo = 'Buenas tardes';
        } elseif ($horaActual->lessThan($horaLimiteNoche)) {
            $mensajeSaludo = 'Buenas noches';
        } else {
            $mensajeSaludo = 'Buenas noches'; // Si la hora es mayor a las 00:00
        }

        return $mensajeSaludo;
    }
    public function avanceDelProyecto($id)
    {
        $resultado = 0;
        DB::statement("CALL avance_de_proyecto(?, @output)", [$id]);
        $result = DB::select("SELECT @output AS output");
        $resultado = $result[0]->output;
        return $resultado;
    }
}
