@extends('layouts.nav')

@section('content-nav')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<div class="container">
    <div class="calendar" id="calendar" data-pruebas="{{ json_encode($pruebas) }}"> 
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var pruebas = JSON.parse(document.getElementById('calendar').getAttribute('data-pruebas')); // Recibimos las pruebas en JSON
        // Generar el arreglo tasks a partir de las pruebas obtenidas del controlador
        var tasks = pruebas.map(function(prueba) {
            return {
                title: prueba.codigo, // Usar la propiedad correcta de la prueba
                start: prueba.fechaEntrega, // Usar la propiedad correcta de la prueba
                
            };
        });
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'es',
          events: tasks
        });
        calendar.render();
      });
</script>
@endsection
