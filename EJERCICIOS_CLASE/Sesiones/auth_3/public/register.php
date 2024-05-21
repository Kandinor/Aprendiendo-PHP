<?php
include '../src/includes/config.php';
include '../src/includes/functions.php';
include '../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth($pdo);
    $register = $auth->register($email, $password);

    if ($register) {
        echo "<p>Registro exitoso. Por favor, verifica tu correo electrónico para activar tu cuenta.</p>";
    } else {
        echo "<p>Registro fallido. Inténtalo nuevamente.</p>";
    }
}
?>

<form method="POST" action="">
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Registrar</button>
</form>

<?php
include '../templates/footer.php';
?>
