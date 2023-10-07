<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CorreoMasivo;
use App\Models\User;

class CorreoController extends Controller
{
    //
    public function mostrarFormulario()
    {
        return view('email.enviarCorreo');
    }

    public function enviarCorreo(Request $request)
    {
        try{
        $asunto = $request->asunto;
        $contenido = $request->contenido;
        
        // Aquí puedes validar los datos y realizar otras acciones necesarias
        $usuarios = User::all();
        foreach($usuarios as $usuario){
            // Envía el correo personalizado
            Mail::to($usuario->email)->send(new CorreoMasivo($asunto, $contenido));

        }
        return redirect()->route('usuarios.index')->with('success', 'Enviado correctamente.');
        }catch (\Exception $e)
        {
            return redirect()->route('usuarios.index')->with('error', 'Ocurrió un error al enviar correos: ' . $e->getMessage());
        }

        
    }
}
