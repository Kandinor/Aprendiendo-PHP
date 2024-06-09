<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //conexion base de datos
    require_once './db/conexion.php';

    //variables 
    $nombre = "";
    $direccion = "";
    $suscripcion = "";
    $generos = [];
    $errores = [];

    if(isset($_POST['enviar'])){

        if (isset($_POST['nombre']) && !empty($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
        } else {
            $errores["nombre"] = "El campo nombre es obligatorio.";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form pedidos</title>
    <style>
        label{
            display: block;
        }

        .error{
            color: brown;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion">

        <label for="suscripcion">Suscripción</label>
        <input type="radio" name="suscripcion" value="mensual" <?= isset($suscripcion) && $suscripcion === 'mensual' ? 'checked' : '' ?>> Mensual
        <input type="radio" name="suscripcion" value="trimestral" <?= isset($suscripcion) && $suscripcion === 'trimestral' ? 'checked' : '' ?>> Trimestral
            <?php if (isset($errores['suscripcion'])): ?>
                <span class="error"><?= htmlspecialchars($errores['suscripcion']) ?></span>
            <?php endif; ?> <br><br>

        <!-- Mostrar géneros como checkboxes -->
        <label for="generos[]">Generos</label>
        <?php  foreach ($generos as $genero):?>
            echo '<input type="checkbox" name="generos[]" value="' . $genero['genero_id'] . '"> ' . $genero['nombre'] . '<br>';
        <?php  endforeach ?>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>