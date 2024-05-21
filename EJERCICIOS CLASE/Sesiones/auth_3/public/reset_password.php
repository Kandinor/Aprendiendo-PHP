<?php
include '../src/includes/config.php';
include '../src/includes/functions.php';
include '../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $auth = new Auth($pdo);
    $reset = $auth->sendPasswordReset($email);

    if ($reset) {
        echo "<p>Correo para restablecer contraseña enviado. Revisa tu correo.</p>";
    } else {
        echo "<p>Error al enviar correo. Inténtalo nuevamente.</p>";
    }
}
?>

<form method="POST" action="">
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>
    <button type="submit">Enviar Correo de Recuperación</button>
</form>

<?php
include '../templates/footer.php';
?>
