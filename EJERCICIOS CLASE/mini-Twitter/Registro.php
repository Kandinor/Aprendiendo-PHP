<!-- Formulario para que nuevos usuarios se registren. -->
<!-- Para que los usuarios accedan a su cuenta. -->
<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        body {
            font-family: 'Arial', sans-serif; /* Fuente sencilla y limpia */
            background-color: #f4f4f4; /* Color de fondo suave */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Sombra suave */
            border-radius: 8px; /* Bordes redondeados */
            width: 300px;
        }
        div {
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333; /* Color oscuro para texto */
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd; /* Bordes sutiles */
            border-radius: 4px; /* Bordes ligeramente redondeados */
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007BFF; /* Color de fondo para el botón */
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3; /* Cambio de color al pasar el mouse */
        }
    </style>
</head>

<body>
    <h1>Bienvenid@</h1>

    <h1>Formulario de Registro</h1>
    <form action="" method="POST">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required maxlength="100">
        </div>
        <div>
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required maxlength="100">
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required maxlength="255">
        </div>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>