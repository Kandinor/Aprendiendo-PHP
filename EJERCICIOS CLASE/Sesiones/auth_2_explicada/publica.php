<?php
//En la pública se podrían establecer cosas, no para protección pero si de información.
session_start();
if(isset($_SESSION['acceso']) && $_SESSION['acceso'] == 1){
    $quien = 'Usuario registrado';
}else{
    $quien = 'Usuario anónimo';
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Público</title>
</head>
<body>
    <h1>Área pública <?=$quien?></h1>
</body>
</html>