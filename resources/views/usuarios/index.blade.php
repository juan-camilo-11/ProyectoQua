@extends('layouts.nav')

@section('content-nav')

<div class="row">
    <h2>Gestion de usuarios</h2>
    <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">Buscar</button>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->apellido }}</td>
            <td>{{ $usuario->telefono }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->estado }}</td>
            <td>{{ $usuario->password }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>


@endsection