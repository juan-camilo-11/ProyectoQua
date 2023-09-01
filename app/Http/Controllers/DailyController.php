<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\Pruebas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DailyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = decrypt($_REQUEST['proyecto']); // Obtener el id del proyecto
        $usuarioAutenticado = Auth::user();// Usuario autenticado
        // Obtener la fecha actual
        $fechaActual = Carbon::now()->toDateString();

        $pruebasDelDia = Pruebas::whereDate('fechaEntrega', '=', $fechaActual)
            ->where('usuario_id', $usuarioAutenticado->id)
            ->get();
        // Obtener los IDs de las pruebas del día actual
        $idsPruebasDelDia = $pruebasDelDia->pluck('id');
        // Consulta para obtener los registros en la tabla "Daily" con prueba_id en los IDs de las pruebas
        $dailys = Daily::whereIn('prueba_id', $idsPruebasDelDia)->get();
        return view('scrum.daily',['dailys' => $dailys]);
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
    public function actualizarEstado(Request $request)
    {
        $elementoId = $request->input('elemento_id');
        $nuevoEstado = $request->input('nuevo_estado');
        
    
        // Realiza alguna validación, por ejemplo, verifica si el usuario tiene permiso para actualizar el estado
    
        // Actualiza el estado en la base de datos
        $elemento = Daily::findOrFail($elementoId);
        $elemento->estado = $nuevoEstado;
        $elemento->save();
    
        // Puedes responder con un mensaje de éxito
        return response()->json(['message' => 'Estado actualizado correctamente']);
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
