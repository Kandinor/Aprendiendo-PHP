<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// variables
$archivoPath = 'empleados.json';  
$nombre = '';
$departamento = '';
$mote = '';
$errores = [];

// Funciones
function leerJson($archivoPath) {
    if (file_exists($archivoPath)) {
        $contenidoJson = file_get_contents($archivoPath);
        return json_decode($contenidoJson, true);
    }
    return [];
}

function escribirJson($archivoPath, $datos) {
    $json = json_encode($datos, JSON_PRETTY_PRINT);
    file_put_contents($archivoPath, $json);
}

// Validar y guardar datos
if(isset($_POST["guardar"])){
    if(isset($_POST["nombre"]) && $_POST["nombre"] != ""){
        $nombre = $_POST["nombre"];
    } else {
        $errores["nombre"] = "*El nombre es obligatorio";
    }

    if(isset($_POST["departamento"]) && $_POST["departamento"] != ""){
        $departamento = $_POST["departamento"];
    } else {
        $errores["departamento"] = "*El departamento es obligatorio";
    }

    if(isset($_POST["mote"]) && $_POST["mote"] != ""){
        $mote = $_POST["mote"];
    } else {
        $errores["mote"] = "*El mote es obligatorio";
    }

    if(empty($errores)){
        // Cargar datos
        $datos = leerJson($archivoPath);

        // Guardar nuevo empleado al array
        $datos[] = ["nombre" => $nombre, "departamento" => $departamento, "mote" => $mote];    
        escribirJson($archivoPath, $datos);

        header('Location: index.php');
        exit;
    }
}

// Cargar datos para mostrar
$datos = leerJson($archivoPath);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados_Json</title>
    <style>
        h1 { text-align: center; }
        form { width: 400px; margin: 0 auto; }
        input, textarea { width: 100%; }
        span { color: red; }
        table { width: 50%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Agrega los empleados en Json</h1>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" value="<?=$nombre?>">
        <?php if(isset($errores['nombre'])): ?>
            <span><?=$errores['nombre']?></span><br> 
        <?php endif; ?>

        Departamento: <input type="text" name="departamento" value="<?=$departamento?>">
        <?php if(isset($errores['departamento'])): ?>
            <span><?=$errores['departamento']?></span><br> 
        <?php endif; ?>

        Mote: <input type="text" name="mote" value="<?=$mote?>">
        <?php if(isset($errores['mote'])): ?>
            <span><?=$errores['mote']?></span><br>
        <?php endif; ?>
        <br><br>

        <input type="submit" name="guardar" value="Guardar">
    </form>
    
    <!-- Mostrar datos -->
    <?php if (!empty($datos)): ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Mote</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $fila): ?>
            <tr>
                <td><?= htmlspecialchars($fila['nombre']) ?></td>
                <td><?= htmlspecialchars($fila['departamento']) ?></td>
                <td><?= htmlspecialchars($fila['mote']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

</body>
</html>
