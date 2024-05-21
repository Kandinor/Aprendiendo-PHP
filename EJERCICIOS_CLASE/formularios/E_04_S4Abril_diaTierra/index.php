<?php
require_once 'conexion.php';
$select =$db->prepare("SELECT * FROM Accion");
$select->execute();
$row = $select->fetchAll(PDO::FETCH_ASSOC);

// print_r($row);

// 0.inicializar array a vacío para errores
$errores = [];

// 1.si el usuario envia el formulario:
if(isset($_POST["enviar"]) && $_SERVER['REQUEST_METHOD'] == 'POST'){

    // //2.recibir los datos del form
    // $fecha = $_POST['fecha'];
    // $lugar = $_POST['lugar'];
    // $nombre = $_POST['nombre'] ?: 'Anónimo';// Si no hay nombre, se guarda como 'Anónimo'
    // $descripcion = $_POST['descripcion'] ?: '';// lo mismo

    // 2. verificar errores
    if (empty($_POST['fecha'])) {
        $errores['fecha'] = "La fecha es obligatoria.";
    } else {
        $fecha = $_POST['fecha'];
    }

    if (empty($_POST['lugar'])) {
        $errores['lugar'] = "El lugar es obligatorio.";
    } else {
        $lugar = $_POST['lugar'];
    }
    

    if (!empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        if (strlen($nombre) > 50) {
            $errores['nombre'] = "El nombre no debe exceder los 50 caracteres.";
        }
    } else {
        $nombre = 'Anónimo';
    }
    
    if (!empty($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
        if (strlen($descripcion) > 500) {  
            $errores['descripcion'] = "La descripción no debe exceder los 500 caracteres.";
        }
    }
    
    //falta validar foto


       //si no hay errores
    if(empty($errores)){
        try {
            // Preparar la sentencia SQL para insertar datos
            $insert = $db->prepare("INSERT INTO Accion (fecha, lugar, nombre, descripcion) VALUES (:fecha, :lugar, :nombre, :descripcion)");
            
            // Vincular parámetros
            $insert->bindParam(':fecha', $fecha);
            $insert->bindParam(':lugar', $lugar);
            $insert->bindParam(':nombre', $nombre);
            $insert->bindParam(':descripcion', $descripcion);
            
            // Ejecutar la sentencia
            $insert->execute();
        
            // Redirigir al usuario al listado de acciones
            header("Location: listado.php");
            exit;
        
        } catch (PDOException $e) {
            // En caso de error en la base de datos, agregarlo a los errores
            $errores['db'] = "Error en la base de datos: " . $e->getMessage();
        }
        
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dia de la Tierra</title>
    <style>
        label{
            display: block;
        }
        .error{
            color: red;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: white;
            background-color: #3e8e41;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }


    </style>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data"> <!--para enviar fotos correctamente -->
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="<?=$fecha?>"  placeholder="Ingrese una fecha"><br>
        <?php
            if(isset($errores["fecha"])){
                echo "<span class='error'>{$errores['fecha']}</span>";
            }
        ?>

        <label for="lugar">Lugar:</label>
        <input type="text" name="lugar" value="<?=$lugar?>" placeholder="Ingrese el lugar"><br>
        <?php
            if(isset($errores["lugar"])){
                echo "<span class='error'>{$errores['lugar']}</span>";
            }
        ?>

        <label for="name">Nombre:</label>
        <input type="text" name="nombre" value="<?=$nombre?>" placeholder="Ingrese su nombre"><br>

        <label for="description">Descripción:</label>
        <textarea name="descripcion" value="<?=$descripcion?>" cols="30" rows="8" placeholder="Escriba una descripción"></textarea><br><br>

        <label for="foto">Foto de la acción:</label>
        <input type="file" name="foto" value="<?$foto?>"><br><br>

        <input type="submit" name="enviar" value="Registrar Acción" class="button">
    </form><br><br>
    <button><a href="listado.php" class="otroBoton">Volver</a></button>
</body>
</html>