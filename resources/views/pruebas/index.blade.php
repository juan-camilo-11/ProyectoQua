@extends('layouts.nav')

@section('content-nav')
<a href="{{ route('proyectos.show', decrypt($_REQUEST['proyecto'])) }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>

<div class="row">
    <div class="col">
        <h2 class="my-3">Pruebas</h2>
    </div>

    <!-- Botón de agregar prueba -->
    <div class="col d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#asignarPruebaModal">
            <i class="bi bi-plus"></i>
            Asignar Prueba
        </button>
    </div>
</div>
<!-- Modal de agregar miembro proyecto -->
<div class="modal fade" id="asignarPruebaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Prueba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pruebas.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ decrypt($_REQUEST['proyecto']) }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" class="form-control" id="codigo" name="codigo">
                            </div>

                            <div class="form-group">
                                <label for="usuario">Responsable:</label>
                                <select class="form-control" id="usuario" name="usuario_id">
                                    @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="requisito">Requisito Funcional:</label>
                                <select class="form-control" id="requisito" name="requisito_id">
                                    @foreach($requisitos as $requisito)
                                    <option value="{{ $requisito->id }}">{{ $requisito->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prioridad_fecha">Prioridad y Fecha de entrega</label>
                                <div class="input-group">
                                    <select class="form-control" name="prioridad">
                                        <option value="alta">Alta</option>
                                        <option value="media">Media</option>
                                        <option value="baja">Baja</option>
                                    </select>
                                    <input type="date" class="form-control" name="fechaEntrega" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="pasos">Pasos:</label>
                                <textarea class="form-control" id="pasos" name="pasos" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="resultadoEsperado">Resultado esperado:</label>
                                <textarea class="form-control" id="resultadoEsperado" name="resultadoEsperado" rows="2"></textarea>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>




            </div>
        </div>
    </div>
</div>
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
<div class="row">

    <!-- Formulario para filtros -->
    <form action="{{ route('pruebas.index') }}" method="GET">

        <input type="hidden" name="proyecto" value="{{ $_REQUEST['proyecto'] }}">

        <!-- Filtro -->
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Buscar por código">
                </div>
                <div class="col-md-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="">Seleccionar estado</option>
                        <option value="Asignada">Asiganada</option>
                        <option value="aprobado">Aprobado</option>
                        <option value="no_aprobado">No Aprobado</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="prioridad" class="form-label">Prioridad</label>
                    <select class="form-control" id="prioridad" name="prioridad">
                        <option value="">Seleccionar prioridad</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baja">Baja</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fechaEntrega" class="form-label">Fecha de Entrega</label>
                    <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega">
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="responsable" class="form-label">Responsable</label>
                    <select class="form-control" id="responsable" name="responsable">
                        <option value="">Seleccionar responsable</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Aplicar Filtro</button>
                </div>
            </div>
        </div>

    </form>


</div>
@foreach($requisitos as $requisito)
@if(count($requisito->pruebas) == 0)
@break
@else
@foreach($requisito->pruebas as $prueba)
<!--<div class="row">
    <div class="card card-prueba">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">{{$prueba->codigo}}</h3>
                    <p> {{$prueba->requisito_id == $requisito->id ? $requisito->Nombre : ''}}</p>
                </div>
                <div class="col">
                    @foreach($usuarios as $usuario)
                    @if($prueba->usuario_id == $usuario->id)
                    <p>Responsable: {{$usuario->nombre}}</p>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descripcion" class="font-weight-bold">Descripción</label>
                        <p>{{ $prueba->descripcion }}</p>
                    </div>
                    <div class="form-group">
                        <label for="pasos" class="font-weight-bold">Pasos</label>
                        <p>{{ $prueba->pasos }}</p>
                    </div>
                    <div class="form-group">
                        <label for="resultado_esperado" class="font-weight-bold">Resultado Esperado</label>
                        <p>{{ $prueba->resultadoEsperado }}</p>
                    </div>
                </div>
                <div class="col-md-6 card-prueba-info">
                    <div class="form-group">
                        <label for="estado" class="font-weight-bold">Estado</label>
                        <p>{{ $prueba->estado }}</p>
                    </div>
                    <div class="form-group">
                        <label for="prioridad" class="font-weight-bold">Prioridad</label>
                        <p>{{ $prueba->prioridad }}</p>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega" class="font-weight-bold">Fecha de Entrega</label>
                        <p>{{ $prueba->fechaEntrega }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-dark mx-1" data-bs-toggle="modal" data-bs-target="#editarPrueba{{$prueba->id}}">
                    <i class="bi bi-pencil"></i>
                    Editar
                </button>
                <-- Modal para editar requisito funcional ->
                <div class="modal fade" id="editarPrueba{{$prueba->id}}" tabindex="1" role="dialog" aria-labelledby="editarPrueba{{$prueba->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-registrar-requisito-titulo">Editar Prueba</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('pruebas.update', $prueba->id)}}">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="prioridad">Responsable:</label>
                                                <select name="usuario_id" id="usuario" class="form-control">
                                                    @foreach($usuarios as $usuario)
                                                    <option value="{{$usuario->id}}" {{ $prueba->usuario_id == $usuario->id ? 'selected' : '' }}>
                                                        {{$usuario->nombre}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="prioridad">Requisito Funcional:</label>
                                                <select name="requisito_id" id="requisito" class="form-control">
                                                    @foreach($requisitos as $requisito)
                                                    <option value="{{$requisito->id}}" {{ $prueba->requisito_id == $requisito->id ? 'selected' : '' }}>
                                                        {{$requisito->Nombre}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción:</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{$prueba->descripcion}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="pasos">Pasos:</label>
                                                <textarea class="form-control" id="pasos" name="pasos" rows="3">{{$prueba->pasos}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="resultadoEsperado">Resultado esperado:</label>
                                                <textarea class="form-control" id="resultadoEsperado" name="resultadoEsperado" rows="2">{{$prueba->resultadoEsperado}}</textarea>
                                            </div>
                                        </div>




                                    </div>






                                    <label for="prioridad_fecha">Prioridad y Fecha de entrega</label>
                                    <div class="input-group">
                                        <select class="form-control" name="prioridad">
                                            <option value="alta" {{ $prueba->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                                            <option value="media" {{ $prueba->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                                            <option value="baja" {{ $prueba->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
                                        </select>
                                        <input type="date" class="form-control" name="fechaEntrega" min="{{ date('Y-m-d') }}" value="{{ $prueba->fechaEntrega }}">

                                    </div>


                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success my-4">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><-- Modal Editar ->



                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarPrueba{{$prueba->id}}">
                    <i class="bi bi-trash3"></i>
                    Eliminar
                </button>
                <-- Modal para eliminar --
                <div class="modal fade" id="eliminarPrueba{{$prueba->id}}" tabindex="1" role="dialog" aria-labelledby="eliminarPrueba{{$prueba->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-registrar-requisito-titulo">Eliminar Prueba</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de que desea eliminar este requisito?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('pruebas.destroy', $prueba->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><-- Modal Eliminar --


                @if($prueba->estado == 'Asignada')
                <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#evaluarPrueba{{$prueba->id}}">
                    <i class="bi bi-trash3"></i>
                    Evaluar
                </button>
                @endif
                <!- Modal para evaluar --
                <div class="modal fade" id="evaluarPrueba{{$prueba->id}}" tabindex="1" role="dialog" aria-labelledby="eliminarPrueba{{$prueba->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-registrar-requisito-titulo">Evaluar Prueba</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('evaluaciones.index') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="estado">Estado:</label>
                                        <select class="form-control" id="estado" name="estado">
                                            <option value="aprobado">Aprobado</option>
                                            <option value="no_aprobado">No Aprobado</option>
                                        </select>
                                    </div>

                                    <input type="number" value="{{$prueba->id}}" style="display: none;" name="prueba_id">

                                    <div class="form-group">
                                        <label for="observacion">Observación:</label>
                                        <textarea class="form-control" id="observacion" name="observacion" rows="3" cols="50"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="observacion">Resultado Obtenido:</label>
                                        <textarea class="form-control" id="resultadoObtenido" name="resultadoObtenido" rows="3" cols="50"></textarea>

                                    </div>
                                    <div class="my-3">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Evaluar</button>
                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                </div><!- Modal evaluar --
            </div>
        </div>
    </div>
</div>
-->
@endforeach
@endif
@endforeach


@foreach($pruebas as $prueba)
<div class="row">
    <div class="card card-prueba">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">{{$prueba->codigo}}</h3>
                    @foreach($requisitos as $requisito)
                    <p> {{$prueba->requisito_id == $requisito->id ? $requisito->Nombre : ''}}</p>
                    @endforeach
                </div>
                <div class="col">
                    @foreach($usuarios as $usuario)
                    @if($prueba->usuario_id == $usuario->id)
                    <p>Responsable: {{$usuario->nombre}}</p>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descripcion" class="font-weight-bold">Descripción</label>
                        <p>{{ $prueba->descripcion }}</p>
                    </div>
                    <div class="form-group">
                        <label for="pasos" class="font-weight-bold">Pasos</label>
                        <p>{{ $prueba->pasos }}</p>
                    </div>
                    <div class="form-group">
                        <label for="resultado_esperado" class="font-weight-bold">Resultado Esperado</label>
                        <p>{{ $prueba->resultadoEsperado }}</p>
                    </div>
                </div>
                <div class="col-md-6 card-prueba-info">
                    <div class="form-group">
                        <label for="estado" class="font-weight-bold">Estado</label>
                        <p>{{ $prueba->estado }}</p>
                    </div>
                    <div class="form-group">
                        <label for="prioridad" class="font-weight-bold">Prioridad</label>
                        <p>{{ $prueba->prioridad }}</p>
                    </div>
                    <div class="form-group">
                        <label for="fecha_entrega" class="font-weight-bold">Fecha de Entrega</label>
                        <p>{{ $prueba->fechaEntrega }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-dark mx-1" data-bs-toggle="modal" data-bs-target="#editarPrueba{{$prueba->id}}">
                    <i class="bi bi-pencil"></i>
                    Editar
                </button>
                <!-- Modal para editar requisito funcional -->
                <div class="modal fade" id="editarPrueba{{$prueba->id}}" tabindex="1" role="dialog" aria-labelledby="editarPrueba{{$prueba->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-registrar-requisito-titulo">Editar Prueba</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('pruebas.update', $prueba->id)}}">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="prioridad">Responsable:</label>
                                                <select name="usuario_id" id="usuario" class="form-control">
                                                    @foreach($usuarios as $usuario)
                                                    <option value="{{$usuario->id}}" {{ $prueba->usuario_id == $usuario->id ? 'selected' : '' }}>
                                                        {{$usuario->nombre}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="prioridad">Requisito Funcional:</label>
                                                <select name="requisito_id" id="requisito" class="form-control">
                                                    @foreach($requisitos as $requisito)
                                                    <option value="{{$requisito->id}}" {{ $prueba->requisito_id == $requisito->id ? 'selected' : '' }}>
                                                        {{$requisito->Nombre}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción:</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{$prueba->descripcion}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="pasos">Pasos:</label>
                                                <textarea class="form-control" id="pasos" name="pasos" rows="3">{{$prueba->pasos}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="resultadoEsperado">Resultado esperado:</label>
                                                <textarea class="form-control" id="resultadoEsperado" name="resultadoEsperado" rows="2">{{$prueba->resultadoEsperado}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="prioridad_fecha">Prioridad y Fecha de entrega</label>
                                    <div class="input-group">
                                        <select class="form-control" name="prioridad">
                                            <option value="alta" {{ $prueba->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                                            <option value="media" {{ $prueba->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                                            <option value="baja" {{ $prueba->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
                                        </select>
                                        <input type="date" class="form-control" name="fechaEntrega" min="{{ date('Y-m-d') }}" value="{{ $prueba->fechaEntrega }}">

                                    </div>


                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success my-4">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- Modal Editar -->
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarPrueba{{$prueba->id}}">
                    <i class="bi bi-trash3"></i>
                    Eliminar
                </button>
                <!-- Modal para eliminar -->
                <div class="modal fade" id="eliminarPrueba{{$prueba->id}}" tabindex="1" role="dialog" aria-labelledby="eliminarPrueba{{$prueba->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-registrar-requisito-titulo">Eliminar Prueba</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de que desea eliminar este requisito?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('pruebas.destroy', $prueba->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- Modal Eliminar -->


                @if($prueba->estado == 'Asignada')
                <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#evaluarPrueba{{$prueba->id}}">
                    <i class="bi bi-trash3"></i>
                    Evaluar
                </button>
                @endif
                <!-- Modal para evaluar -->
                <div class="modal fade" id="evaluarPrueba{{$prueba->id}}" tabindex="1" role="dialog" aria-labelledby="eliminarPrueba{{$prueba->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-registrar-requisito-titulo">Evaluar Prueba</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('evaluaciones.index') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="estado">Estado:</label>
                                        <select class="form-control" id="estado" name="estado">
                                            <option value="aprobado">Aprobado</option>
                                            <option value="no_aprobado">No Aprobado</option>
                                        </select>
                                    </div>

                                    <input type="number" value="{{$prueba->id}}" style="display: none;" name="prueba_id">

                                    <div class="form-group">
                                        <label for="observacion">Observación:</label>
                                        <textarea class="form-control" id="observacion" name="observacion" rows="3" cols="50"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="observacion">Resultado Obtenido:</label>
                                        <textarea class="form-control" id="resultadoObtenido" name="resultadoObtenido" rows="3" cols="50"></textarea>

                                    </div>
                                    <div class="my-3">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Evaluar</button>
                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                </div><!-- Modal evaluar -->
            </div>
        </div>
    </div>
</div>

@endforeach




@endsection