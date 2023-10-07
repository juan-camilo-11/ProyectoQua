@extends('layouts.nav')

@section('content-nav')
<div class="">
    <a href="{{ route('usuarios.index') }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>
</div>

<div class="container my-2">
    <h5>Enviar correo a todos los usuarios</h5>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('enviar-correo')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="asunto">Asunto:</label>
                        <input type="text" class="form-control" name="asunto" id="asunto">
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido:</label>
                        <textarea class="form-control" name="contenido" id="contenido"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Enviar Correo</button>
                </form>
            </div>
        </div>
    </div>


@endsection