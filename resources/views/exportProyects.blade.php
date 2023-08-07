<h3>{{$proyecto->nombre}}</h3>
<h6>Tabla de Criterios</h6>
<table>
    <thead>
        <tr class="bg-gris">
            <th class="bg-gris">ID</th>
            <th>Nombre</th>
            <th>Ponderacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyecto->criterios as $criterio)
        <tr>
            <td>{{$criterio->id}}</td>
            <td>{{$criterio->Nombre}}</td>
            <td>{{$criterio->Ponderacion}}%</td>
        </tr>
        <tr>
            <td></td>
            <td><b>Requisitos Funcionales</b></td>
        </tr>
        @foreach($criterio->requisitosFuncionales as $requisito)
        <tr>
            <td></td>
            <td>{{$requisito->id}}</td>
            <td>{{$requisito->Nombre}}</td>
        </tr>
        @endforeach

        @endforeach
    </tbody>
</table>

<h6>Pruebas Realizadas</h6>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Codigo</th>
            <th>Pasos</th>
            <th>Resultado Esperado</th>
            <th>Estado</th>
            <th>Prioridad</th>
            <th>Fecha Entrega</th>
            <th>Responsable</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyecto->criterios as $criterio)

        @foreach($criterio->requisitosFuncionales as $requisito)

        @foreach ($requisito->pruebas as $prueba) {
            <tr>
                <td>{{$prueba->id}}</td>
                <td>{{$prueba->descripcion}}</td>
                <td>{{$prueba->codigo}}</td>
                <td>{{$prueba->pasos}}</td>
                <td>{{$prueba->resultadoEsperado}}</td>
                <td>{{$prueba->estado}}</td>
                <td>{{$prueba->prioridad}}</td>
                <td>{{$prueba->fechaEntrega}}</td>
                <td>{{$prueba->usuario_id}}</td>
            </tr>
        }
      
        @endforeach

        @endforeach

        @endforeach
    </tbody>
</table>