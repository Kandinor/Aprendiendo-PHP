<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start(); // Iniciar la sesión
// Conexión a la base de datos
require_once 'conexion.php';

// Validar la sesión
if (isset($_SESSION['usuario'])) {
    header('Location: listado.php');
    die();
}

// Variables
$usuario = "";
$password = "";
$errores = [];

if (isset($_POST["enviar"])) {

    if (isset($_POST["usuario"]) && !empty($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    } else {
        $errores["usuario"] = "* Debes introducir usuario";
    }

    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        $errores["password"] = "* Debes introducir contraseña";
    }

    // Si no hay errores
    if (empty($errores)) {
        $consulta = $db->prepare("SELECT * FROM usuarios WHERE nombre = :nombre");
        $consulta->bindParam(":nombre", $usuario);
        $consulta->execute();

        $usuario_data = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario_data && password_verify($password, $usuario_data['pass'])) {
            $_SESSION["usuario"] = $usuario_data;
            header("Location: listado.php");
            die();
        } else {
            $errores["general"] = "Usuario o contraseña incorrectos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <!--formulario de login -->
    <form action="" method="post">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" value="<?= htmlspecialchars($usuario) ?>">
        <?php if (isset($errores['usuario'])): ?>
            <span class="error"><?php echo $errores['usuario']; ?></span><br>
        <?php endif; ?><br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <?php if (isset($errores['password'])): ?>
            <span class="error"><?php echo $errores['password']; ?></span><br>
        <?php endif; ?><br>
        <?php if (isset($errores['general'])): ?>
            <span class="error"><?php echo $errores['general']; ?></span><br>
        <?php endif; ?><br>
        <input type="submit" name="enviar" value="Enviar">
        <a href="recupera_listado.php">recupera_listado</a>
    </form>

</body>
</html>
