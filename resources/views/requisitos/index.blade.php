@extends('layouts.nav')

@section('content-nav')


<a href="{{ route('proyectos.show', decrypt($_REQUEST['proyecto'])) }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>

<div class="row">
  <div class="col">
    <h2 class="my-5">Requisitos</h2>
  </div>
  <!-- Botón de agregar requisito funcional -->
  <div class="col d-flex align-items-center justify-content-end">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-registrar-requisito">
      <i class="bi bi-plus"></i>
      Agregar Requisito
    </button>
  </div>
  <!-- Modal para agregar requisito funcional -->
  <div class="modal fade" id="modal-registrar-requisito" tabindex="-1" role="dialog" aria-labelledby="modal-registrar-requisito-titulo" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-registrar-requisito-titulo">Registrar Requisito</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('requisitos.store')}}">
            @csrf
            <div style="display: none;">
              <input type="number" name="proyecto_id" value="{{decrypt($_REQUEST['proyecto'])}}" >
            </div>
            
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div class="form-group">
              <label for="criterio">Criterio Asociado:</label>
              <select name="criterio_id" id="criterio" class="form-control">
                @foreach ($criterios as $criterio)
                <option value="{{ $criterio->id }}" style="text-transform: capitalize;">{{ $criterio->Nombre }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary my-4">Registrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
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
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Criterio Asociado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

      @foreach($requisitos as $requisito)
      <tr>
        <td>{{ $requisito->id }}</td>
        <td class="">{{ $requisito->Nombre }}</td>
        <td class="">{{ $requisito->criterio->Nombre }}</td>
        <td class="d-flex justify-content-around">
          


          <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editarRequisito{{$requisito->id}}">
            <i class="bi bi-pencil"></i>
            Editar
          </button>
          <!-- Modal para editar requisito funcional -->
          <div class="modal fade" id="editarRequisito{{$requisito->id}}" tabindex="1" role="dialog" aria-labelledby="editarRequisito{{ $requisito->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-registrar-requisito-titulo">Editar Requisito Funcional</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('requisitos.update', $requisito->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $requisito->Nombre }}">
                    </div>

                    <div class="form-group">
                      <label for="criterio">Criterio Asociado:</label>
                      <select name="criterio_id" id="criterio" class="form-control">
                        @foreach($criterios as $criterio)
                        <option style="text-transform: capitalize;" value="{{ $criterio->id }}" @if($requisito->criterio->id == $criterio->id) selected @endif>{{ $criterio->Nombre }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-outline-success my-4">Actualizar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div><!-- Modal Editar -->
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarRequisito{{$requisito->id}}">
            <i class="bi bi-trash3"></i>
            Eliminar
          </button>
          <!-- Modal para eliminar -->
          <div class="modal fade" id="eliminarRequisito{{$requisito->id}}" tabindex="1" role="dialog" aria-labelledby="eliminarRequisito{{$requisito->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-registrar-requisito-titulo">Eliminar Requisito Funcional</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Está seguro de que desea eliminar este requisito?
                </div>
                <div class="modal-footer">
                  <form action="{{ route('requisitos.destroy', $requisito->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                </div>
              </div>
            </div>
          </div><!-- Modal Eliminar -->
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row d-flex justify-content-end w-100 nav-next">
    {{ $requisitos->appends( [ 'proyecto' => ( $_REQUEST [ 'proyecto' ] ) ] )->links() }}
  </div>
</div>
@endsection