<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a QUA</title>
</head>
<body>
    <table>
        <tr>
            <td>
                <img src="{{ asset('img/logo.png') }}" alt="QUA">
            </td>
            <td>
                <h1>Bienvenido a QUA</h1>
            </td>
        </tr>
    </table>
    <p>¡Hola {{ $user->nombre }}!</p>
    <p>Gracias por registrarte en QUA. Esperamos que disfrutes de tu experiencia.</p>
    <p>Atentamente,<br>El equipo de QUA</p>
</body>
</html>
