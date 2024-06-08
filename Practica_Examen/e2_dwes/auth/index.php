<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
//conexion base de datos
require_once 'conexion.php';

//obtener tokens

$consulta = $db -> prepare("SELECT token FROM auth_tokens WHERE consumido = 0");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <h1>
        Listado de enlaces de autentificación
    </h1>
    <ul>
        <li><a href="">login 1</a></li>
        <li><a href="">login 2</a></li>
        <li><a href="">...</a></li>
    </ul>
</body>
</html>