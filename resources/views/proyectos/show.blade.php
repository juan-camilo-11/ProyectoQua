@extends('layouts.nav')

@section('content-nav')
@if($cargo == "Scrum Master")
<div class="row">
    <div class="col">
        <h2 class="my-3">{{$proyecto->nombre}}</h2>
    </div>
    
    <!-- Botón de agregar miembro proyecto -->
    <div class="col d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearProyectoModal">
            <i class="bi bi-plus"></i>
            Agregar Miembro
        </button>
    </div>
    
</div>
<!-- Modal de agregar miembro proyecto -->
<div class="modal fade" id="crearProyectoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar miembro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('proyectos.agregar-miembro')}}">
                    @csrf
                    <input type="number" name="proyecto_id" value="{{$proyecto->id}}" style="display: none;">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Correo del invitado:</label>
                            <input type="email" name="correo" id="correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cargo_id">Cargo:</label>
                            <select class="form-control" id="cargo_id" name="cargo_id">
                                <option value="Product Owner">Product Owner</option>
                                <option value="Team" selected>Team</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

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


@if($cargo == "Scrum Master")
<div class="row items">
    <a href="{{route('criterios.index', ['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Criterios<i class="bi bi-chevron-right mx-2"></i></a>
    <a href="{{route('requisitos.index', ['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Requisitos funcionales<i class="bi bi-chevron-right mx-2"></i></a>
    <a href="{{route('pruebas.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Pruebas<i class="bi bi-chevron-right mx-2"></i></a>
    <a href="" class="my-2">Evaluaciones<i class="bi bi-chevron-right mx-2"></i></a>
    <a href="" class="my-2">Seguimiento<i class="bi bi-chevron-right mx-2"></i></a>
</div>

<div class="row">
<h2>Miembros</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)

            <tr>
                <td>{{$usuario->nombre}}</td>
                <td class="estado {{ $usuario->estado == 'Activo' ? 'activo' : 'cerrado' }}"><span>{{$usuario->estado}}</span></td>
                <td>{{$usuario->pivot->cargo_id}}</td>
                <td>Eliminar</td>
            </tr>
            @endforeach
    </tbody>
    </table>
</div>

@elseif($cargo == "Product Owner")
    <a href="{{route('criterios.index', ['proyecto' => encrypt($proyecto->id)])}}">Criterios</a>
    <a href="{{route('requisitos.index', ['proyecto' => encrypt($proyecto->id)])}}">Requisitos funcionales</a>
    <a href="{{route('pruebas.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Pruebas<i class="bi bi-chevron-right mx-2"></i></a>
    <a href="">Evaluaciones</a>

@elseif($cargo == "Team")
<a href="{{route('pruebas.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Pruebas<i class="bi bi-chevron-right mx-2"></i></a>
    <a href="">Evaluaciones</a>
@else
    <h2>No perteneces a este proyecto</h2>
    <a href="{{route('home')}}">Volver :3</a>
@endif

@endsection