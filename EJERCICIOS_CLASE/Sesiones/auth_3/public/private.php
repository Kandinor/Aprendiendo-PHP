<?php
include '../src/includes/config.php';
include '../src/includes/functions.php';
include '../templates/header.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
}

// Mensaje de bienvenida
$user_email = $_SESSION['user_email'];
echo "<h1>Bienvenido, $user_email</h1>";
?>

<p>Esta es una página privada. Solo los usuarios autenticados pueden verla.</p>

<a href="logout.php">Cerrar Sesión</a>

<?php
include '../templates/footer.php';
?>
