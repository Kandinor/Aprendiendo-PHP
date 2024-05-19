<!-- Formulario para que nuevos usuarios se registren. -->
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//conexion base de datos
require_once 'Conexion.php';

session_start();

//variables
$nombre = "";
$contrasena = "";
$correo ="";
$errores=[];

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

    if(isset($_POST["correo"]) && $_POST["correo"] != ""){
        if(filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)){
            $correo = $_POST["correo"];
        }else{
            $errores ["correo"]= "*El correo no es correcto";
        }
    }else{
        $errores ["correo"]= "*El correo es obligatorio";
    }

    if(empty($errores)){
        try{
            //1. preparar la sentencia INSERT
            $insert = $db -> prepare("INSERT INTO USUARIOS(NOMBRE, CORREO, CONTRASENA) VALUES(:nombre, :correo, :contrasena)");

            //2. Vincular parámetros
            $insert -> bindParam(":nombre", $nombre);
            $insert -> bindParam(":correo", $correo);
            $insert -> bindParam(":contrasena", $contrasena);
            // $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            //3. Ejecutar la sentencia
            $insert -> execute();
            //4. Obtener el ID del usuario insertado
            $id = $db -> lastInsertId();

            header("Location: feed-privada.php");
            exit;

        }catch(PDOException $e){
            echo "Error al insertar el usuario: " . $e->getMessage();
        }
        

    }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarme</title>
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
            padding: 30px;
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
        .button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007BFF; 
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .button:hover {
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
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?=$nombre?>">
            <?php
                if(isset($errores["nombre"])){
                    echo "<span class='error'>{$errores['nombre']}</span>";
                }
            ?>
        </div>
        <div>
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?=$correo?>">
            <?php
                if(isset($errores["correo"])){
                    echo "<span class='error'>{$errores['correo']}</span>";
                }
            ?>
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" value="<?=$contrasena?>">
            <?php
                if(isset($errores["contrasena"])){
                    echo "<span class='error'>{$errores['contrasena']}</span>";
                }
            ?>
        </div>
        <input type="submit" name="enviar" value="Registrarme" class="button">
    </form>
</body>
</html>