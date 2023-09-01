@extends('layouts.nav')

@section('content-nav')
<a href="{{ route('proyectos.show', decrypt($_REQUEST['proyecto']) ) }}" class="btn btn-gris"><i class="bi bi-arrow-left"></i></a>
<div class="alert alert-info" role="alert" id="loadingAlert" style="display: none; margin: 1rem auto;">
    Procesando datos, por favor espera...
</div>

<div class="alert alert-success" role="alert" id="successAlert" style="display: none; margin: 1rem auto;">
    Datos recibidos y procesados correctamente
</div>

<div class="alert alert-danger" role="alert" id="errorAlert" style="display: none; margin: 1rem auto;">
    Ha ocurrido un error al procesar los datos
</div>

<h2>Daily</h2>
<button id="registrarBtn" class="btn btn-primary">Confirmar</button>

<div class="container">
    <h2>Pruebas</h2>
    <ul class="sortable-list">
        
        @foreach($dailys->where('estado', 'En espera') as $daily)
        <li data-id="{{$daily->id}}">{{$daily->codigo}}</li>
        @endforeach
    </ul>
    <h2>En proceso</h2>
    <ul class="sortable-list en-proceso-list">
        @foreach($dailys->where('estado', 'En proceso') as $daily)
        <li data-id="{{$daily->id}}">{{$daily->codigo}}</li>
        @endforeach
    </ul>
    <h2>Terminado</h2>
    <ul class="sortable-list terminado-list">
        @foreach($dailys->where('estado', 'Terminado') as $daily)
        <li data-id="{{$daily->id}}">{{$daily->codigo}}</li>
        @endforeach
    </ul>
</div>


<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Aplicar SortableJS a todas las listas
    const listas = document.querySelectorAll('.sortable-list');
    listas.forEach(lista => {
        Sortable.create(lista, {
            animation: 150,
            group: 'shared',
            onEnd: function (event) {
            const item = event.item;
            const listaDestino = event.to;

            // Determinar el nuevo estado en función de la lista de destino
            let nuevoEstado = '';
            if (listaDestino.classList.contains('en-proceso-list')) {
                nuevoEstado = 'En proceso';
            } else if (listaDestino.classList.contains('terminado-list')) {
                nuevoEstado = 'Terminado';
            }

            // Actualizar el estado del elemento
            const elementoId = item.getAttribute('data-id'); // Asegúrate de tener un atributo data-id
            actualizarEstadoEnBaseDeDatos(elementoId, nuevoEstado);
        }
        });
    });
    
    const registrarBtn = document.getElementById('registrarBtn');
    function actualizarEstadoEnBaseDeDatos(elementoId, nuevoEstado) {
    // Realiza una solicitud AJAX para actualizar el estado en la base de datos
    fetch('/daily/cambiar-estado', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                elemento_id: elementoId,
                nuevo_estado: nuevoEstado
            })
           
        }).then(response => {
            return response.json();
        }).then(data =>{
            
            document.getElementById('loadingAlert').style.display = 'none';
            document.getElementById('successAlert').style.display = 'block';
            setTimeout(function () {
                document.getElementById('successAlert').style.display = 'none';
            }, 2000);
        })
        .catch(error => {
            
            console.error('Error al enviar la solicitud AJAX:', error);
            document.getElementById('loadingAlert').style.display = 'none';
            document.getElementById('errorAlert').style.display = 'block';
            setTimeout(function () {
                document.getElementById('errorAlert').style.display = 'none';
            }, 2000);
        });

    }
</script>
@endsection