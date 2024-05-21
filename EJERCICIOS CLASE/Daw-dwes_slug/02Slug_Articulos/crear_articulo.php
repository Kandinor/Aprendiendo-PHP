<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once './base_datos/conexion.php';

//variables
$titulo ='';
$contenido ='';
$fecha= '';
$errores=[];


function generarSlug($cadena) {
    $cadena = strtolower(trim($cadena));
    $cadena = preg_replace('/[^a-z0-9-]/', '-', $cadena);
    $cadena = preg_replace('/-+/', '-', $cadena);
    return rtrim($cadena, '-');
}

if(isset($_POST['enviar'])){

    $slug = generarSlug($titulo);
    
    if (isset($_POST['titulo']) && trim($_POST['titulo']) !== '') {
        $titulo = trim($_POST['titulo']);
    } else {
        $errores['titulo'] = "El título es obligatorio";
    }

    if (isset($_POST['contenido'])) {
        $contenido = $_POST['contenido'];
    } else {
        $errores['contenido'] = "El contenido es obligatorio";
    }

    if (isset($_POST['fecha']) && trim($_POST['fecha']) !== '') {
        $fecha = trim($_POST['fecha']);
    } else {
        $errores['fecha'] = "La fecha es obligatoria";
    }

    // Si no hay errores, inserta en la base de datos
    if (empty($errores)) {

        // Preparar la sentencia SQL para insertar datos
        $insert = $db->prepare('INSERT INTO ARTICULOS (TITULO, CONTENIDO, FECHA, slug) VALUES (:titulo, :contenido, :fecha, :slug)');

        // Vincular parámetros
        $insert->bindParam(':titulo', $titulo);
        $insert->bindParam(':contenido', $contenido);
        $insert->bindParam(':fecha', $fecha);
        $insert->bindParam(':slug', $slug);
        

         // Ejecutar la sentencia
        if ($insert->execute()) {
            echo "Artículo creado exitosamente";
        } else {
            echo "Error al crear el artículo";
        }

        header('Location: listado_articulos.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear articulo</title>
    <style>
        label{
            display: block;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($titulo); ?>">
        <?php if (isset($errores['titulo'])): ?>
            <div class="error"><?php echo htmlspecialchars($errores['titulo']); ?></div>
        <?php endif; ?>

        <label for="contenido">Contenido</label>
        <input type="text" name="contenido" id="contenido" value="<?php echo htmlspecialchars($contenido); ?>">
        <?php if (isset($errores['contenido'])): ?>
            <div class="error"><?php echo htmlspecialchars($errores['contenido']); ?></div>
        <?php endif; ?>

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($fecha); ?>">
        <?php if (isset($errores['fecha'])): ?>
            <div class="error"><?php echo htmlspecialchars($errores['fecha']); ?></div>
        <?php endif; ?>

        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>