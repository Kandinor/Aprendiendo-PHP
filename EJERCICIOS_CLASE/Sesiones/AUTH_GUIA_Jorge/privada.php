<?php

    require_once 'init.php';

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Privada </title>
</head>
<body>
    
</body>
</html>