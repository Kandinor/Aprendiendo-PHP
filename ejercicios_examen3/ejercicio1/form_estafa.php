<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexion a la base de datos
require_once 'conexion.php';

// Variables
$errores = [];
$url = "";
$estafa = "";
$descripcion = "";
$telefono = "";

if(isset($_POST["enviar"]) && $_SERVER['REQUEST_METHOD'] == 'POST'){

    if (isset($_POST["url"])) {
        $url = $_POST["url"];
        if (empty($url)) {
            $errores["url"] = "*Debe ingresar la URL";
        }
    } else {
        $errores["url"] = "*Debe ingresar la URL";
    }

    if (isset($_POST["estafa"])) {
        $estafa = $_POST["estafa"];
    } else {
        $errores["estafa"] = "*Por favor selecciona una estafa.";
    }

    if (isset($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
        if (empty($descripcion) || strlen($descripcion) > 500) {
            $errores['descripcion'] = "La descripción es obligatoria y no debe exceder los 500 caracteres.";
        }
    }

    if (isset($_POST['telefono'])) {
        $telefono = $_POST['telefono'];
    }

    // Si no hay errores
    if(empty($errores)){
        try {
            // Preparar la sentencia SQL para insertar datos
            $insert = $db->prepare("INSERT INTO estafas (fraud_url, fraud_type, description, phone) VALUES (:fraud_url, :fraud_type, :description, :phone)");
            
            // Vincular parámetros
            $insert->bindParam(':fraud_url', $url);
            $insert->bindParam(':fraud_type', $estafa);
            $insert->bindParam(':description', $descripcion);
            $insert->bindParam(':phone', $telefono);
            
            // Ejecutar la sentencia
            $insert->execute();
        
            // Redirigir 
            header("Location: exito.php");
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
    <title>Document</title>
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
    <form action="" method="POST">

    <label for="url">URL de la página de la estafa</label>
    <input type="text" name="url" id="" value="<?= htmlspecialchars($url) ?>" >
    <?php
        if(isset($errores["url"])){
            echo "<span class='error'>{$errores['url']}</span>";
        }
    ?><br><br>

    <label for="estafa">Tipo de Estafa</label>
    <select name="estafa" id="">
        <option value="1" <?= $estafa === '1' ? 'selected' : '' ?>>Falsificación identidad</option>
        <option value="2" <?= $estafa === '2' ? 'selected' : '' ?>>Precio demasiado bajo</option>
        <option value="3" <?= $estafa === '3' ? 'selected' : '' ?>>Solicitud pago adelantado</option>
        <option value="4" <?= $estafa === '4' ? 'selected' : '' ?>>Promesas servicios no existen</option>
    </select>
    <?php if (isset($errores['estafa'])): ?>
        <span class="error"><?= htmlspecialchars($errores['estafa']) ?></span>
    <?php endif; ?><br><br>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" cols="30" rows="8" placeholder="Escriba una descripción"><?= htmlspecialchars($descripcion) ?></textarea><br><br>
    <?php if (isset($errores['descripcion'])): ?>
        <span class="error"><?= htmlspecialchars($errores['descripcion']) ?></span>
    <?php endif; ?><br>

    <label for="telefono">Teléfono</label>
    <input type="tel" name="telefono" id="" value="<?= htmlspecialchars($telefono) ?>">

    <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
