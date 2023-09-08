<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        
        /* Estilos de la tabla */
        .tabla-pdf {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        .tabla-pdf thead th {
            background-color: #1E1E1E;
            color: #fff;
            font-weight: bold;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }
        
        .tabla-pdf tbody td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .tabla-pdf tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        /* Estilos para las celdas de porcentaje */
        .porcentaje {
            font-weight: bold;
            text-align: center;
        }
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    
</head>
<body>
   <div class="header" style="display: flex;">
        <h1 style="background-color: #000; text-align: center; padding: .5rem;color: #fff; font-weight: bold; text-decoration: none;">QU<Span style="color: #FAFF00;">A</Span></h1>
        <h1 style="text-transform: capitalize; font-weight: bold;">{{$proyecto->nombre}}</h1>

        
   </div>
    
    <table class="tabla-pdf">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ponderación</th>
            <th>Aprobacion</th>
            <th>Asignacion</th>
            <th>No aprobacion</th>
            <th>Cumplimiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $result)
            <tr>
                <td style="text-transform: capitalize; font-weight: bold;">{{ $result->nombre }}</td>
                <td>{{ $result->ponderacion }}%</td>
                <td>{{ $result->resultadoA }}%</td>
                <td>{{ $result->resultadoAs }}%</td>
                <td>{{ $result->resultadoNo }}%</td>
                <th>{{($result->resultadoA/100)*$result->ponderacion}}/{{$result->ponderacion}}</th>

            </tr>
        @endforeach
    </tbody>
</table>



<h1>Pruebas</h1>

<div>


    @foreach ($criterios as $criterio)
    <h1>{{ $criterio->Nombre }}</h1>
    
    @foreach ($requisitos as $r)
        @if ($criterio->id == $r->criterio_id)
            
                @foreach ($pruebas as $p)
                    @if ($p->requisito_id == $r->id)
                        @if (!isset($tiposMostrados[$p->Tipo]))
                            <h2>{{ $p->Tipo }}</h2>
                            <?php $tiposMostrados[$p->Tipo] = true; ?>
                        @endif
                        <table border="1"  class="tabla-pdf">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Estado</th>
                                <th>Prioridad</th>
                                <th>Fecha de Entrega</th>
                                <th>Usuario ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $p->codigo }}</td>
                                <td>{{ $p->estado }}</td>
                                <td>{{ $p->prioridad }}</td>
                                <td>{{ $p->fechaEntrega }}</td>
                                <td>{{ $p->usuario_id }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                @endforeach
            
        @endif
    @endforeach
@endforeach


</div>

</body>
</html>