<?php
session_start();
require_once 'conexion.php';

//variables
$errores = [];
$usuario ="";
$password ="";

if(isset($_POST["enviar"]) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    } 

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
    }

    if (empty($usuario) || empty($password)) {
        $errores[] = "estos campos son bligatorios";
    } 
    if (empty($errores)) {
        $stmt = $db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
        // var_dump($user);

        if ($user && password_verify($password, $user['password'])) {
            // echo "hola0";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if($user['role']== 0){
                header('Location: privada1.php');
                exit;
            }

            if($user['role']== 1){
                header('Location: privada2.php');
                exit;
            }
        }else{
            $errores[] = "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        label {
            display: block;
        }
        .error {
            color: brown;
        }
    </style>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if ($errores): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li class="error"><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="usuario">Usuario</label>
        <input type="text"  name="usuario" value="<?=$usuario?>">
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <br>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
