<?php 
$errores= [];
$usuario = "";
$correo = "";
$contrasena = "";

if(isset($_POST["enviar"])){

    if (isset($_POST["usuario"]) && isset($_POST["usuario"]) != ""){
        $usuario = $_POST["usuario"];
    }else{
        $errores[] = "*El usuario es obligatorio";
    }

    if (isset($_POST["correo"]) && isset($_POST["correo"]) != ""){
        $contrasena = $_POST["correo"];
    }else{
        $errores[] = "*el correo no es correcto";
    }

    if (isset($_POST["contrasena"]) && isset($_POST["contrasena"]) != "" && isset($_POST["contrasena"]) != "123"){
        $contrasena = $_POST["contrasena"];
    }

    //si no hay errores
    if(empty($errores)){
        header("location: exito.php");
        die(); //OJO SIEMPRE  PONER O exit;

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="usuario">Nombre usuario:</label><br>
        <input type="text" name="usuario" value="<?=$usuario?>"><br>
        <label for="correo">correo</label>
        <input type="text" name="correo" value="<?=$correo?>"><br>
        <label for="contrasena">Contraseña:</label><br>
        <input type="text" name="contrasena" value="<?=$contrasena?>"><br> 
        <input type="submit" name="enviar" value="Enviar">
    </form>

</body>
</html>