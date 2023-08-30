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
<p>Numero de prueba realizadas: 100</p>
<div>
    <h3>Funcionaldiad</h3>
    <p>Tipo de prueba</p>
    <table class="tabla-pdf">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Estado</th>
                <th>Fecha de Entrega</th>
                <th>Responsable</th>
                <th>Prioridad</th>
        
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Tipo de prueba</p>
    <table class="tabla-pdf">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Estado</th>
                <th>Fecha de Entrega</th>
                <th>Responsable</th>
                <th>Prioridad</th>
        
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Tipo de prueba</p>
    <table class="tabla-pdf">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Estado</th>
                <th>Fecha de Entrega</th>
                <th>Responsable</th>
                <th>Prioridad</th>
        
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>