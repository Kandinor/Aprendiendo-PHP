<!-- Donde los usuarios pueden editar su nombre de usuario. -->
<?php
//me conecto a la base de datos
require_once 'Conexion.php';

//inicio de sesion para recoger el nombre
session_start(); 

//comprobar que el usuario sigue autenticado
if (!isset($_SESSION['usuario'])) {
    die("Acceso restringido");
}

if(isset($_SESSION["usuario"])){
    $id_usuario = $_SESSION["usuario"]["ID"];
    $nombre_usuario = $_SESSION["usuario"]["NOMBRE"];
}else{
    header("Location: Inicio-Sesion.php?error=true");
}

$errores=[];
if(isset($_POST["enviar"])){
    // Recoger los valores del formulario
    if(isset($_POST["nombre_nuevo"]) && $_POST["nombre_nuevo"] != ""){
        $nuevo_nombre = $_POST['nombre_nuevo'];
    }else{
        $errores['nombre_nuevo']= "*El nuevo nombre no puede estar vacío";
    }

    //SI NO HAY ERRORES
    if(empty($errores)){
        try{
            // Preparar la sentencia SQL para insertar datos OJO CON LOS NOMBRES DE LAS TABLAS
            $update = $db->prepare("UPDATE USUARIOS SET NOMBRE = :nombre WHERE ID=:id");
            $update -> bindParam(":id", $id_usuario);
            $update -> bindParam(":nombre", $nuevo_nombre) ;

            // Ejecutar la sentencia SQL
            $update -> execute();

            $_SESSION["usuario"]["NOMBRE"] = $nuevo_nombre;
            $nombre_usuario = $nuevo_nombre; //o puedo poner el header location

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <a href="logout.php">Cerrar sesión</a>
    </header>


    <!-- <= print_r($_SESSION["usuario"])?> -->
    <h1>perfil</h1>
    <p>Hola <?= $nombre_usuario; ?></p>

    <button id="editar">Editar</button>
    <form id="miFormulario" class="hidden" method="post">

        <label for="nombre_nuevo">Nuevo nombre:</label>
        <input type="text"  name="nombre_nuevo">

        <button type="submit" name="enviar">Enviar</button>
    </form>
    <?php if (!empty($errores)): ?>
        <div>
            <?php foreach ($errores as $error): ?>
                <p><?= htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <script>
        var botonEditar = document.getElementById("editar");
        var formulario = document.getElementById("miFormulario");

        botonEditar.addEventListener("click", function() {
            formulario.classList.toggle("hidden");
        });
    </script>
</body>
</html>