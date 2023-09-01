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

<h2>Backlog</h2>
<button id="registrarBtn" class="btn btn-primary">Confirmar</button>
<div class="container mt-5">
    <h2>Lista de requisitos</h2>
    <div class="row">
        <div class="col-md-6">
            <ul id="lista" class="sortable-list" style="list-style: none; padding: 0;">
                @foreach($requisitos as $requisito)
                <li style="border: 1px solid #000; margin: 0.5rem auto; display:flex; justify-content:space-around; align-items:center">
                    <p style="padding: 0.3rem; font-weight: bold;">ID: <span style="font-weight: normal;">{{$requisito->id}}</span></p>
                    <p style="padding: 0.3rem; font-weight: bold;">Nombre: <span style="font-weight: normal;">{{$requisito->Nombre}}</span></p>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            @for ($i = 1; $i <= $diasRestantes; $i++)
                <h3>Dia {{ $i }}</h3>
                <ul id="lista{{ $i }}" class="sortable-list" data-dia="{{ $i }} " style="list-style: none; padding: 0;"></ul>
            @endfor
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
     // Aplicar SortableJS a todas las listas
    const listas = document.querySelectorAll('.sortable-list');
    listas.forEach(lista => {
        Sortable.create(lista, {
            animation: 150,
            group: 'shared',
          
        });
    });

    const proyectoId = '{{$_REQUEST['proyecto']}}';
    // Capturar clic en el botón "Registrar"
    const registrarBtn = document.getElementById('registrarBtn');
    
    registrarBtn.addEventListener('click', () => {
        document.getElementById('loadingAlert').style.display = 'block';
        const registros = [];
        for (let i = 1; i <= {{ $diasRestantes }}; i++) {
            const lista = document.getElementById('lista' + i);
            const dia = lista.getAttribute('data-dia');
            const elementos = [];
            lista.querySelectorAll('li').forEach(elemento => {
                const requisitoId = elemento.querySelector('p span:first-child').textContent.trim();
                const nombreElemento = elemento.querySelector('p span:last-child').textContent.trim();
                elementos.push({ requisitoId, nombreElemento });
            });
            registros.push({ dia, proyectoId, elementos });
        }
        console.log(registros);
        // Enviar registros al servidor mediante una solicitud AJAX
        fetch('/backlog', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(registros)
        }).then(response => {
            return response.json();
        }).then(data =>{
            
            document.getElementById('loadingAlert').style.display = 'none';
            document.getElementById('successAlert').style.display = 'block';
        })
        .catch(error => {
            
            console.error('Error al enviar la solicitud AJAX:', error);
            document.getElementById('loadingAlert').style.display = 'none';
            document.getElementById('errorAlert').style.display = 'block';
        });
    });

</script>
@endsection