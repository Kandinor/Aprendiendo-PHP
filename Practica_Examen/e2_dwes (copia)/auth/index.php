<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
//conexion base de datos
require_once 'conexion.php';

//obtener tokens
$select = $db -> prepare("SELECT token FROM auth_tokens");
$select->execute();
$tokens = $select->fetchAll(PDO::FETCH_ASSOC);

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
        <?php foreach($tokens as $token): ?>
            <li><a href="auth.php?token=<?= $token['token'] ?>">Login con token <?= $token['token']?></a></li>
        <?php endforeach;?>
    </ul>
</body>
</html>