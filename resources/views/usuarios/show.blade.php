@extends('layouts.nav')

@section('content-nav')
<div class="container">
    <h1>Informacion de Usuario</h1>
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <p class="card-text" id="nombre">{{auth()->user()->nombre}} {{auth()->user()->apellido}}</p>
            <h5 class="card-title">Teléfono</h5>
            <p class="card-text" id="telefono">{{auth()->user()->telefono}}</p>
            <h5 class="card-title">Correo</h5>
            <p class="card-text" id="correo">{{auth()->user()->email}}</p>
            <h5 class="card-title">Estado</h5>
            <p class="card-text" id="estado">{{auth()->user()->estado}}</p>
            <!-- Boton para editar usuario -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarUsuario{{auth()->user()->id}}">
                Editar
            </button>

            <!-- Modal -->
            <div class="modal fade" id="editarUsuario{{auth()->user()->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('usuarios.update',auth()->user()->id)}}" method="POST">
                            @csrf
                            @method('patch')
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{auth()->user()->nombre}}">
                                </div>
                                <div class="form-group">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido" value="{{auth()->user()->apellido}}">
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{auth()->user()->telefono}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo:</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{auth()->user()->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado:</label>
                                    <select name="estado" class="form-control">
                                        <option value="activo" @if (auth()->user()->estado == 'activo') selected @endif>Activo</option>
                                        <option value="inactivo" @if (auth()->user()->estado == 'inactivo') selected @endif>Inactivo</option>
                                    </select>
                                </div>
                                <div class="form-group d-flex justify-content-end my-2">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .Modal editar usuario -->
            <!-- Boton para editar usuario -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cambiarC{{auth()->user()->id}}">
                Cambiar Contraseña
            </button>

            <!-- Modal -->
            <div class="modal fade" id="cambiarC{{auth()->user()->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar contraseña</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('cambiar-contrasena')}}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="password_actual">Contraseña actual:</label>
                                    <input type="password" name="password_actual" id="password_actual" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password_nueva">Nueva contraseña:</label>
                                    <input type="password" name="password_nueva" id="password_nueva" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password_nueva_confirmation">Confirmar contraseña:</label>
                                    <input type="password" name="password_nueva_confirmation" id="password_nueva_confirmation" class="form-control">
                                </div>
                                <div class="form-group d-flex justify-content-end my-2">
                                    <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div><!-- .Modal editar usuario -->
        </div>
    </div>
</div>
@endsection