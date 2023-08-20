@extends('layouts.nav')

@section('content-nav')
<a href="{{ route('proyectos.show', decrypt($_REQUEST['proyecto'])) }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>

<h3>Evaluaciones</h3>
<div class="container">
  <div class="row">
    @foreach ($evaluaciones as $evaluacion)
      <div class="col-md-6">
        <div class="card m-3">
        <div class="card-headerd card-evaluacion-header">
        @foreach ($pruebas as $prueba)
              @if($evaluacion->prueba_id == $prueba->id)
                <h5 class="card-title"><b>Prueba:</b> {{$prueba->codigo}}</h5>
                <p class="card-text"><b>Estado:</b>
                  @if($prueba->estado == "no_aprobado")    
                  <span class="text-white bg-danger" style="border-radius: .2rem;padding:.2rem;">No aprobado</span>
                  @else
                  <span class="text-white bg-success" style="border-radius: .2rem;padding:.2rem;">Aprobado</span>
                  @endif
                </p>
                <h6 class="card-text"><b>Resultado Esperado:</b> {{$prueba->resultadoEsperado}}</h6>
              @endif
            @endforeach
        </div>
          <div class="card-body">
            <p class="card-text"><b>Observación:</b> {{$evaluacion->observacion}}</p>
            <p class="card-text"><b>Resultado obtenido:</b> {{$evaluacion->resultadoObtenido}}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>


@endsection