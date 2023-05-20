<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proyectos_tienen_usuarios;

class proyectos_tiene_usuarios extends Controller
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
    public function store($proyecto_id, $usuario_id, $cargo_id)
    {
        // Para usuarios que crean el proyecto por tanto el cargo es: Scrum Master
        
        $proyecto = new proyectos_tienen_usuarios;
        $proyecto->usuario_id = $usuario_id;
        $proyecto->proyecto_id = $proyecto_id;
        $proyecto->cargo_id = $cargo_id;
        $proyecto->save();
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
