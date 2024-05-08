<?php
session_start();

$pagina_origen = isset($_SESSION['$pagina_origen']) ? $_SESSION['$pagina_origen']:'privada1.php';

$nombreUsuario = $_POST['usuario'];

if(isset($_POST['pass']) && $_POST['pass'] == 'contraseña'){
    $_SESSION['acceso'] = 1;
    header("Location: $pagina_origen");
    die();
}else{
    $_SESSION['acceso'] = 0;
    unset($_SESSION['$pagina_origen']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <form action="auth.php" method="post">
        Indica tu nombre y tu pass:
        <input type="text" name="usuario" id="" placeholder="Nombre">
        <input type="text" name="pass" id="" placeholder="Contraseña">
        <input type="submit" value="Entrar" name="enviar">
    </form>
</body>
</html>