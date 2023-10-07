@extends('layouts.nav')

@section('content-nav')
<!-- Botón de crear proyecto -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearProyectoModal">
    <i class="bi bi-plus"></i>
    Crear proyecto
</button>
<!-- Modal de crear proyecto -->
<div class="modal fade" id="crearProyectoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('proyectos.store') }}">
                    @csrf
                    <input type="number" name="usuario_id" value="{{ auth()->user()->id }}" style="display: none">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre del proyecto:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="objetivo">Objetivo del proyecto:</label>
                            <textarea name="objetivo" id="objetivo" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                        <label for="fechaFin">Fecha de Finalizacion:</label>
                        <input type="date" class="form-control" id="fechaFin" name="fechaFin" min="{{ date('Y-m-d') }}">
                        </div>  
                    </div>
                    
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<h2 class="my-3">Mis proyectos</h2>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Finalizacion</th>
            <th>Cargo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyectos as $proyecto)
        <tr>
            <td><a href="{{route('proyectos.show', $proyecto->id)}}" class="proyecto-nombre">{{$proyecto->nombre}}</a></td>
            <td class="estado {{ $proyecto->estado == 'Activo' ? 'activo' : ($proyecto->estado == 'Inactivo' ? 'inactivo' : 'finalizado') }}"><span>{{$proyecto->estado}}</span></td>
            <td>{{$proyecto->fechaFin}}</td>
            <td>{{$proyecto->usuarios->first()->cargo_id  }}</td>
        </tr>
        @endforeach
   </tbody>
</table>
{{$proyectos->links()}}


@endsection