<!-- Para que los usuarios accedan a su cuenta. -->
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//conexion base de datos
require_once 'Conexion.php';

session_start();

//variables
$nombre = "";
$contrasena = "";
$errores=[];

//mostrarle error si se quiere meter directamente en el area privada
if(isset($_GET["error"])){
    $error= "Debes loguearte para ver tu perfil";
}

//validacion
if(isset($_POST["enviar"])){

    if(isset($_POST["nombre"]) && $_POST["nombre"] != ""){
        $nombre = $_POST["nombre"];
    }else{
        $errores ["nombre"]= "*El nombre es obligatorio";
    }

    if(isset($_POST["contrasena"]) && $_POST["contrasena"]!= ""){
        $contrasena = $_POST["contrasena"];
    }else{
        $errores ["contrasena"]= "*La contraseña es obligatoria";
    }

    //si no hay errores
    if(empty($errores)){
        $consulta = $db -> prepare("SELECT * FROM USUARIOS WHERE NOMBRE = :nombre AND CONTRASENA =:contrasena");
        //TODO HACER LA CONTRASEÑA HASH

        $consulta -> bindParam(":nombre", $nombre);
        $consulta -> bindParam(":contrasena", $contrasena);
        $consulta -> execute();

        $usuario = $consulta -> fetch(PDO::FETCH_ASSOC);

        if($usuario){
            $_SESSION["usuario"] = $usuario;
            header("Location: feed-privada.php");
        }else{
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
    <title>Inicio de Sesión</title>
    <style>
        body {
            font-family: 'Arial', sans-serif; 
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            border-radius: 8px;
            width: 300px;
        }
        div {
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px; 
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007BFF; 
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3; 
        }

        .error{
            color: red;
        }
    </style>
</head>

<body>
    
    
    <h1>Bienvenid@</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $nombre?>">
        <?php if(isset($errores['nombre'])): ?>
            <span class="error"><?php echo $errores['nombre']; ?></span><br>
        <?php endif; ?><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" value="<?= $contrasena?>">
        <?php if(isset($errores['contrasena'])): ?>
            <span class="error"><?php echo $errores['contrasena']; ?></span><br>
        <?php endif; ?><br><br>

        <button type="submit" name="enviar">Entrar</button>
        <a href="">olvidé mi contraseña</a>
    </form>
    <!-- sustituyo esto por el ternario que es más estricto y me ahorro el isset -->
    <p class="error"><?=$error??""?></p>
    <!-- <p><= isset($error)?$error:""?></p> -->
</body>
</html>