@extends('layouts.nav')

@section('content-nav')
<h3 class="my-2">{{ $mensaje }}, {{ auth()->user()->nombre }}!</h3>
<div class="row cards-dash my-4">
    <div class="col card-dashboard">
        <div class="row d-flex align-items-center">
            <div class="col-2 d-flex justify-content-center">
                <span class="span-warning">
                    <i class="bi bi-dash"></i>
                </span>
            </div>
            <div class="col-10">
                <h6 class="card-title">Pruebas Asignadas</h6>
                <p class="card-text">{{$PruebasAsignadas}}</p>
            </div>
        </div>
    </div>
    <div class="col card-dashboard">
        <div class="row d-flex align-items-center">
            <div class="col-2 d-flex justify-content-center">
                <span class="span-success">
                    <i class="bi bi-check"></i>
                </span>
            </div>
            <div class="col-8">
                <h6 class="card-title">Pruebas Aprobadas</h6>
                <p class="card-text">{{$PruebasAprobadas}}</p>
            </div>
        </div>
    </div>
    <div class="col card-dashboard">
        <div class="row d-flex align-items-center">
            <div class="col-2 d-flex justify-content-center">
                <span class="span-danger">
                <i class="bi bi-x"></i>
                </span>
            </div>
            <div class="col-8">
                <h6 class="card-title">Pruebas No Aprobadas</h6>
                <p class="card-text">{{$PruebasNoAprobadas}}</p>
            </div>
        </div>

    </div>
</div>
<div class="row my-4">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Estado</th>
                    <th>Avance</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->nombre }}</td>
                    <td><span class="badge bg-success">{{$proyecto->estado}}</span></td>
                    <td>{{$proyecto->avance}}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $proyectos->links() }}
    </div>
    <div class="col">
        <a href="{{route('calendario.index')}}">Calendario</a>
    </div>
</div>
@endsection