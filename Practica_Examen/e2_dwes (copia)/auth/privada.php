<?php 
session_start();
var_dump($_SESSION);

if(!isset($_SESSION['email'])){
    header("Location: index.php");
    die();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>privada</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <h2>Hola <?= $email?></h2>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>