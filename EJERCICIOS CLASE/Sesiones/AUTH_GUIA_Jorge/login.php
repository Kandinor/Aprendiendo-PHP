<?php
    require_once 'init.php';

    if (isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }

    $errores = [];

    if (isset($_POST['loguearte'])) {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
        $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : null;

        if (empty($nombre)) {
            $errores['nombre'] = "El nombre de usuario es obligatorio";
        }

        if (empty($contrasena)) {
            $errores['contrasena'] = "La contraseña es obligatoria";
        }

        if (empty($errores)) {
            $aVerificar = $conexion->ejecuta("SELECT * FROM usuarios WHERE nombre = ?", $nombre);
            
            if ($aVerificar->rowCount() == 1) {
                $usuario = $aVerificar->fetch();
                if (password_verify($contrasena, $usuario['contrasena'])) {
                    $_SESSION['usuario'] = $usuario;
                    header("Location: index.php");
                    exit();
                } else {
                    $errores['contrasena'] = "La contraseña no es correcta";
                }
            } else {
                $errores['nombre'] = "El nombre de usuario no existe";
            }

            header("Location: index.php");
            exit();
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
</head>
<body>
    <h1> Inicio de sesión </h1>
    <form action="" method="post">
        <input type="text" name="nombre"> <br>
        <input type="password" name="contrasena"> <br>
        <input type="checkbox" name="recordar"> Recordarme <br>
        <input type="submit" name="loguearte" value="Iniciar sesión">
    </form>
</body>
</html>