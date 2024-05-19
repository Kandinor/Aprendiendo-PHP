<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Artículos slug</title>
    <style>
        label{
            display: block;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="">

        <label for="contenido">Contenido</label>
        <input type="text" name="contenido" id="">

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="">
    </form>
</body>
</html>