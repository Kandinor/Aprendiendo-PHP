<?php 
$accion = $_GET['accion'];
$entidad = $_GET['entidad'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sobre la entidad <?= $entidad?></h1>
    <h2>realizó <?= $accion?> </h2>
</body>
</html>