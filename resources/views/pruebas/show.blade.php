@extends('layouts.nav')

@section('content-nav')
<button onclick="window.history.back()" class="btn btn-gris"><i class="bi bi-arrow-left"></i></button>
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

                <form action="" method="POST">
                    @csrf


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



@endsection