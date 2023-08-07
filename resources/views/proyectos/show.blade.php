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

<div class=" row items">
   <div class="">
    <ul>
        <li>
        <a href="{{route('criterios.index', ['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Criterios</a>
        </li>
        <li>
        <a href="{{route('requisitos.index', ['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Requisitos</a>
        </li>
        <li>
        <a href="{{route('pruebas.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Pruebas</a>
        </li>
        <li>
        <a href="{{route('evaluaciones.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Evaluaciones</a>
        </li>
        <li>
        <a href="{{route('seguimiento.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Seguimiento</a>
        </li>
    </ul>
   </div>
</div>

@elseif($cargo == "Product Owner")
<div class="row">
<h2 class="my-3">{{$proyecto->nombre}}</h2>
</div>
<div class="row items">
    <div class="div">
        <ul>
        <li>
        <a href="{{route('criterios.index', ['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Criterios</a>
        </li>
        <li>
        <a href="{{route('requisitos.index', ['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Requisitos</a>
        </li>
        <li>
        <a href="{{route('pruebas.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Pruebas</a>
        </li>
        <li>
        <a href="{{route('evaluaciones.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Evaluaciones</a>
        </li>
        </ul>
    </div>
</div>
@elseif($cargo == "Team")
<div class="row">
    <h2 class="my-3">{{$proyecto->nombre}}</h2>
</div>
<div class="row items">
    <div>
        <ul>
            <li>
                <a href="{{route('pruebas.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Pruebas</a>
            </li>
            <li>
                <a href="{{route('evaluaciones.index',['proyecto' => encrypt($proyecto->id)])}}" class="my-2">Evaluaciones</a>
            </li>
        </ul>
    </div>
</div>
@elseif($cargo == "2")

@else
<h2>No perteneces a este proyecto</h2>
<a href="{{route('home')}}">Volver :3</a>
@endif



<div class="row progreso">
    
    <h2 class="">Progreso</h2>
    @foreach ($criterios as $criterio)
    <div class="row">
        <div class="col">
        <p><span>{{ $criterio->Nombre }}</span></p>
        </div>
        <div class="col">
        <p><span>ponderacion:</span> {{ $criterio->Ponderacion }}%</p>
        </div>
        <div class="col">
        @if ($criterio->progreso->ResultadoAprobado || $criterio->progreso->ResultadoAsignado || $criterio->progreso->ResultadoNo)
        <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" 
        style="width: {{ $criterio->progreso->ResultadoAprobado }}%" 
        aria-valuenow="{{ $criterio->progreso->ResultadoAprobado }}" aria-valuemin="0" aria-valuemax="100">
        {{ $criterio->progreso->ResultadoAprobado }}%</div>
        <div class="progress-bar bg-info" role="progressbar" 
        style="width: {{ $criterio->progreso->ResultadoAsignado }}%" 
        aria-valuenow="{{ $criterio->progreso->ResultadoAsignado }}" aria-valuemin="0" aria-valuemax="100">
        {{ $criterio->progreso->ResultadoAsignado }}%</div>
        <div class="progress-bar bg-danger" role="progressbar" 
        style="width: {{ $criterio->progreso->ResultadoNo  }}%" 
        aria-valuenow="{{$criterio->progreso->ResultadoNo   }}" aria-valuemin="0" aria-valuemax="100">
        {{ $criterio->progreso->ResultadoNo  }}%</div>
        </div>
        @else
        <p>No hay resultado</p>
        @endif
        </div>
    </div>
   
    @endforeach

</div>
<div class="row">
    <h2>Miembros</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Cargo</th>
                @if($cargo == "Scrum Master")
                <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)

            <tr>
                <td>{{$usuario->nombre}}</td>
                <td class="estado {{ $usuario->estado == 'activo' ? 'activo' : 'cerrado' }}"><span>{{$usuario->estado}}</span></td>
                <td>{{$usuario->pivot->cargo_id}}</td>
                @if($cargo == "Scrum Master")
                <td>Eliminar</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection