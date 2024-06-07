<?php
require_once("conexion.php");

$query = $db->query("SELECT token FROM tokens WHERE fecha_validez > NOW() AND consumido = 0");
$tokens = $query->fetchAll(PDO::FETCH_ASSOC);

header("Lacation: login.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <!-- listado de enlaces para recuperar contraseña con varios tokens -->
    <div id="contenedor">
        <h1>Recuperar contraseña</h1>
        <ul>
            <?php foreach ($tokens as $token): ?>
                <li><a href="recupera.php?token=<?= htmlspecialchars($token['token']) ?>">Recuperar contraseña</a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
