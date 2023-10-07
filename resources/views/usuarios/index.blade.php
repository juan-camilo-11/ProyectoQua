@extends('layouts.nav')

@section('content-nav')

@if(session('success'))
<div class="alert alert-success my-2">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger my-2">
    {{ session('error') }}
</div>
@endif
<div class="row">
    <h2>Gestion de usuarios</h2>
    <div class="row my-3">
    <div class="col">
        <a href="{{ route('crear-correo') }}" class="btn btn-primary">Enviar correo</a>
    </div>
</div>
    <div class="mb-3">
        <form action="{{route('usuarios.index')}}">
            <div class="row">
                <div class="col">
                    <input type="text" name="atributo" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
                </div>
                <div class="input-group-append col">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <table class="table mx-3">
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
    <div class="row d-flex justify-content-end w-100 nav-next">
        {{ $usuarios->links() }}
    </div>
</div>


@endsection