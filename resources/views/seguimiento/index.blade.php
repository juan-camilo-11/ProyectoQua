@extends('layouts.nav')

@section('content-nav')
<h2>Seguimiento</h2>
<h6>{{$proyecto->nombre}}</h6>

<a href="{{route('exportar',['id' => $proyecto->id])}}" class="btn btn-primary"><i class="bi bi-file-earmark-arrow-down"></i>Exportar en Excel</a>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ponderación</th>
            <th>Porcentaje de Aprobacion</th>
            <th>Porcentaje de Asignacion</th>
            <th>Porcentaje de No aprobacion</th>
            <th>Cumplimiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $result)
            <tr>
                <td style="text-transform: capitalize; font-weight: bold;">{{ $result->nombre }}</td>
                <td>{{ $result->ponderacion }}%</td>
                <td>{{ $result->resultadoA }}%</td>
                <td>{{ $result->resultadoAs }}%</td>
                <td>{{ $result->resultadoNo }}%</td>
                <th>{{($result->resultadoA/100)*$result->ponderacion}}/{{$result->ponderacion}}</th>

            </tr>
        @endforeach
    </tbody>
</table>
<h5>Pruebas Realizadas</h5>
<table class="table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Estado</th>
            <th>Prioridad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pruebas as $prueba)
            <tr>
                <td>{{ $prueba->codigo }}</td>
                <td>{{ $prueba->estado }}</td>
                <td>{{ $prueba->prioridad }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



@endsection