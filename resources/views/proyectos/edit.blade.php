@extends('layouts.nav')

@section('content-nav')
<a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>
<h1>Informacion del Proyecto</h1>
<div class="container">

    @if(session('success'))
    <div class="alert alert-danger">
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
            <p class="card-text" id="nombre">{{$proyecto->nombre}}</p>
            <h5 class="card-title">Objetivo</h5>
            <p class="card-text" id="telefono">{{$proyecto->objetivo}}</p>
            <h5 class="card-title">Fecha Fin</h5>
            <p class="card-text" id="correo">{{$proyecto->fechaFin}}</p>
            <h5 class="card-title">Estado</h5>
            <p class="card-text" id="estado">{{$proyecto->estado}}</p>
            <!-- Boton para editar proyevto -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar{{$proyecto->id}}">
                Editar
            </button>

            <!-- Modal -->
            <div class="modal fade" id="editar{{$proyecto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Proyecto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('proyectos.update',[$proyecto->id])}}" method="POST">
                                @csrf
                                @method('patch')

                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proyecto->nombre }}">
                                </div>

                                <div class="form-group">
                                    <label for="objetivo">Objetivo</label>
                                    <textarea class="form-control" id="objetivo" name="objetivo">{{ $proyecto->objetivo }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="fechaFin">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="{{ $proyecto->fechaFin }}" min="{{ date('Y-m-d') }}">
                                </div>


                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="Activo" {{ $proyecto->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ $proyecto->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                        <option value="Finalizado" {{ $proyecto->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                    </select>
                                </div>

                                <div class="form-group d-flex justify-content-end my-2">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- .Modal editar proyecto -->
      
        </div>
    </div>
</div>

@endsection