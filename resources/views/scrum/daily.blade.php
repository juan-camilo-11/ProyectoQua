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
<div style="display: flex; justify-content:space-between">
    <h2>Daily</h2>
    <button id="registrarBtn" class="btn btn-primary">Confirmar</button>
</div>


<div class="container">
    <h4>Pruebas</h4>
    <ul class="sortable-list" style="list-style: none;">
        
        @foreach($dailys->where('estado', 'En espera') as $daily)
            <li data-id="{{$daily->id}}" style="background-color: #aaa; margin: .2rem auto; text-align: center;">{{$daily->codigo}}</li>
        @endforeach
    </ul>
    <h4>En proceso</h4>
    <ul class="sortable-list en-proceso-list" style="list-style: none;">
        @foreach($dailys->where('estado', 'En proceso') as $daily)
        <li data-id="{{$daily->id}}" style="background-color: #3498DB ; margin: .2rem auto; text-align: center;">{{$daily->codigo}}</li>
        @endforeach 
    </ul>
    <h4>Terminado</h4>
    <ul class="sortable-list terminado-list" style="list-style: none;">
        @foreach($dailys->where('estado', 'Terminado') as $daily)
        <li data-id="{{$daily->id}}" style="background-color: #2ECC71 ; margin: .2rem auto; text-align: center;">{{$daily->codigo}}</li>
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