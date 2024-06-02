<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("conexion.php");

//variables:
$nombre = "";
$fecha = "";
$flor = "";
$cantidad = "";
$errores = [];
$direccion = "";

// Obtener flores para el select porque me da error en el forea
try {
    $select = $db->prepare("SELECT id, nombre, stock FROM flores");
    $select->execute();
    $flores = $select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener flores: " . $e->getMessage());
}

//procesar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {
        $nombre = $_POST["nombre"];
    } else {
        $errores["nombre"] = "*Debe tener nombre";
    }

    if (isset($_POST["fecha"]) && $_POST["fecha"] > date("Y-m-d") && $_POST["fecha"] != "") {
        $fecha = $_POST["fecha"];
    } else {
        $errores["fecha"] = "*Debe tener fecha y ser posterior a hoy";
    }

    if (isset($_POST["flor"])) {
        $flor = $_POST["flor"];
    }

    if (isset($_POST["cantidad"]) && is_numeric($_POST["cantidad"]) && $_POST["cantidad"] > 0) {
        $cantidad = $_POST["cantidad"];
    } else {
        $errores["cantidad"] = "*Debe tener cantidad válida";
    }

    if (isset($_POST["direccion"]) && $_POST["direccion"] != "") {
        $direccion = $_POST["direccion"];
    } else {
        $errores["direccion"] = "*Pon la direccion a la cual enviarte el pedido";
    }

    if (empty($errores)) {
        $select = $db->prepare("SELECT stock FROM flores WHERE id = :id");
        $select->bindParam(':id', $flor, PDO::PARAM_INT);
        $select->execute();
        $stock = $select->fetchColumn();

        if ($cantidad > $stock) {
            $errores["stock"] = "No hay suficiente stock.";
        }

        if (empty($errores)) {
            try {
                // Registrar pedido
                if (empty($errores)) {
                    $insert = $db->prepare("INSERT INTO pedidos (flor_id, direccion, fecha, unidades) VALUES (:flor_id, :direccion, :fecha, :unidades)");
                    $insert->bindParam(':flor_id', $flor, PDO::PARAM_INT);
                    $insert->bindParam(':direccion', $direccion, PDO::PARAM_STR);
                    $insert->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                    $insert->bindParam(':unidades', $cantidad, PDO::PARAM_INT);
                    $insert->execute();
                

                    // Actualizar stock
                    $nuevo_stock = $stock - $cantidad;
                    $update = $db->prepare("UPDATE flores SET stock = ? WHERE id = ?");
                    $update->execute([$nuevo_stock, $flor]);

                    // Redirigir a éxito
                    header("Location: exito.php");
                    die();
                }
            } catch (PDOException $e) {
                die("Error al registrar pedido: " . $e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedido</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        /* label {
            display: block;
        }
        .error {
            color: brown;
        } */
    </style>
</head>
<body>
    <form action="form.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($nombre) ?>">
        <?php
            if (isset($errores["nombre"])) {
                echo "<span class='error'>{$errores['nombre']}</span>";
            }
        ?>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($fecha) ?>">
        <?php
            if (isset($errores["fecha"])) {
                echo "<span class='error'>{$errores['fecha']}</span>";
            }
        ?>

        <label for="flor">Flor</label>
        <select name="flor" id="flor">
            <?php foreach ($flores as $florItem): ?>
                <option value="<?= $florItem['id'] ?>" <?= $flor == $florItem['id'] ? "selected" : "" ?>>
                    <?= htmlspecialchars($florItem['nombre']) ?> (<?= $florItem['stock'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" value="<?= htmlspecialchars($cantidad) ?>">
        <?php
            if (isset($errores["cantidad"])) {
                echo "<span class='error'>{$errores['cantidad']}</span>";
            }
            if (isset($errores["stock"])) {
                echo "<span class='error'>{$errores['stock']}</span>";
            }
        ?>
        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" id="" value="<?=$direccion?>">
        <?php 
            if(isset($errores["direccion"])){
                echo "<span class='error'>{$errores["direccion"]}</span>";
            }
        ?>
        <br><br>

        <input type="submit" name="enviar" value="Comprar">
    </form>
</body>
</html>
