<?php
// index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="container mt-5">
            <a href="/detalle/producto-1" class="btn btn-primary">Detalle de Producto 1</a><br>
            <a href="/detalle/producto-2" class="btn btn-secondary">Detalle de Producto 2</a><br>
            <a href="/detalle/producto-3" class="btn btn-success">Detalle de Producto 3</a><br>
        </div>
    </div>
</body>

</html>