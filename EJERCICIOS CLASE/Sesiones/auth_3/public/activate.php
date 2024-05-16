<?php
include '../src/includes/config.php';
include '../src/includes/functions.php';
include '../templates/header.php';

$token = $_GET['token'] ?? '';

if ($token) {
    $auth = new Auth($pdo);
    $activate = $auth->activateUser($token);

    if ($activate) {
        echo "<p>Cuenta activada exitosamente. Ya puedes iniciar sesión.</p>";
    } else {
        echo "<p>Token inválido o expirado.</p>";
    }
} else {
    echo "<p>Token no proporcionado.</p>";
}

include '../templates/footer.php';
?>
