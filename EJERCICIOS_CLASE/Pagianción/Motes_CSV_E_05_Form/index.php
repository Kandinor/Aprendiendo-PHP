<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Define la ruta del archivo CSV
$archivoPath = 'empleados.csv';  
$nombre = '';
$departamento = '';
$mote = '';
$errores = [];
$filasPorPagina = 5; // Número de empleados por página

function leerCsv($archivoPath) {
    $datos = [];
    if (($handle = fopen($archivoPath, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $datos[] = $data;
        }
        fclose($handle);
    }
    return $datos;
}

function escribirCsv($archivoPath, $datos) {
    $handle = fopen($archivoPath, 'w');  // Abre el archivo en modo de escritura
    foreach ($datos as $linea) {
        fputcsv($handle, $linea);
    }
    fclose($handle);
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
        $datos = leerCsv($archivoPath);
        $datos[] = [$nombre, $departamento, $mote];
        escribirCsv($archivoPath, $datos);
        
        header('Location:index.php');
        exit;
    }
}

// Cargar datos para mostrar
$datos = leerCsv($archivoPath);

$totalFilas = count($datos);
$totalPaginas = ceil($totalFilas / $filasPorPagina);
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$paginaActual = max(1, min($totalPaginas, $paginaActual));
$inicio = ($paginaActual - 1) * $filasPorPagina;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados_paginacion</title>
    <style>
        h1 {
            text-align: center;
        }
        form {
            width: 400px;
            margin: 0 auto;
        }
        input {
            width: 100%;
        }
        span {
            color: red;
        }
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .pagination{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Agrega los empleados en CSV</h1>
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
            <?php
            for ($i = $inicio; $i < min($inicio + $filasPorPagina, $totalFilas); $i++):
                $fila = $datos[$i];
            ?>
            <tr>
                <td><?= htmlspecialchars($fila[0]) ?></td>
                <td><?= htmlspecialchars($fila[1]) ?></td>
                <td><?= htmlspecialchars($fila[2]) ?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="?pagina=<?=$i?>"><?=$i?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>

</body>
</html>
