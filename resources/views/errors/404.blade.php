<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .error-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        a {
            text-decoration: none;
            font-weight: bold;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Error 404 - Página no encontrada</h1>
        <p>Lo sentimos, la página que estás buscando no se encuentra disponible.</p>
        <a href="{{route('home')}}">Volver a la página de inicio</a>
    </div>
</body>
</html>
