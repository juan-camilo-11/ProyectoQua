@extends('layouts.nav')

@section('content-nav')
<a href="{{ route('proyectos.show', decrypt($_REQUEST['proyecto'])) }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>

<h2>SCRUM</h2>

<div class=" row items">
   <div class="">
    <ul>
        <li>
        <a href="{{ route('backlog.index', ['proyecto' => $_REQUEST['proyecto'] ] ) }}" class="my-2">Backlog</a>
        </li>
        <li>
        <a href="{{ route('daily.index', ['proyecto' => $_REQUEST['proyecto'] ] ) }}" class="my-2">Daily</a>
        </li>
    </ul>
   </div>
</div>

<div class="container mt-5">
    <h2>Backlog</h2>
    <table class="table">
        <thead  style="color: fff;" >
            <tr style="background-color: #1E1E1E; color: #fff">
                <th>Dia</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
            <tr>
                <td>{{$registro->dia}}</td>
                <td>{{$registro->requisito->Nombre}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection