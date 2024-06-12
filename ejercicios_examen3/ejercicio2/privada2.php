<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: Login.php');
    exit;
}

if ($_SESSION['role'] != 1 && $_SESSION['role'] != 0) {
    // echo 'No tienes permiso para acceder a esta área.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>privada2</title>
</head>
<body>
    <h2>otros</h2>
    <p>aqui puedes registrar la info del refugio y los reportes de maltrato animal</p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>