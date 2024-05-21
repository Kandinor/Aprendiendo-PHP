<?php
include '../src/includes/config.php';
include '../src/includes/functions.php';
include '../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth($pdo);
    $login = $auth->login($email, $password);

    if ($login) {
        header('Location: private.php');
        exit();
    } else {
        echo "<p>Inicio de sesión fallido. Inténtalo nuevamente.</p>";
    }
}
?>

<form method="POST" action="">
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Iniciar Sesión</button>
</form>

<?php
include '../templates/footer.php';
?>
