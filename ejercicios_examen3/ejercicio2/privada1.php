<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: Login.php');
    exit;
}

// if ($_SESSION['role'] != 1) {
//     echo 'No tienes permiso para acceder a esta área.';
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Privada 1</title>
</head>
<body>
    <h1>admin</h1>
    <p>aqui pueden gestionar la informacion del refugio</p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
