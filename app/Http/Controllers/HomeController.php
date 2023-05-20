<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


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
        return view('home')->with('mensaje', $mensaje);
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
    

}
