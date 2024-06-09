<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Conexión a la base de datos
require_once './db/conexion.php';

// Inicializar variables
$nombre = "";
$direccion = "";
$suscripcion = "";
$generos = [];
$generosSeleccionados = [];
$errores = [];

// Obtener los géneros musicales
try {
    $query = 'SELECT * FROM generos_musicales';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $generos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

//validar
if (isset($_POST['enviar'])) {
    if (isset($_POST['nombre']) && !empty($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
    } else {
        $errores["nombre"] = "*El campo nombre es obligatorio.";
    }

    if (isset($_POST['direccion']) && !empty($_POST["direccion"])) {
        $direccion = $_POST["direccion"];
    } else {
        $errores["direccion"] = "*El campo dirección es obligatorio.";
    }

    if (isset($_POST['suscripcion']) && !empty($_POST["suscripcion"])) {
        $suscripcion = $_POST["suscripcion"];
    } else {
        $errores["suscripcion"] = "*El campo suscripción es obligatorio.";
    }

    if (isset($_POST['generos']) && !empty($_POST["generos"])) {
        $generosSeleccionados = $_POST["generos"];
    } else {
        $errores["generos"] = "*Debe seleccionar al menos un género.";
    }

    if (empty($errores)) {
        try {
            // Insertar cliente
            $query = 'INSERT INTO clientes (nombre, direccion, suscripcion) VALUES (:nombre, :direccion, :suscripcion)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':suscripcion', $suscripcion);
            $stmt->execute();
            $cliente_id = $db->lastInsertId();

            // Insertar géneros asociados al cliente
            foreach ($generosSeleccionados as $genero_id) {
                $query = 'INSERT INTO clientes_generos (cliente_id, genero_id) VALUES (:cliente_id, :genero_id)';
                $stmt = $db->prepare($query);
                $stmt->bindParam(':cliente_id', $cliente_id);
                $stmt->bindParam(':genero_id', $genero_id);
                $stmt->execute();
            }

            // Redirigir a la página de éxito
            header('Location: exito.php');
            exit();

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Suscripción</title>
    <style>
        label{
            display: block;
        }
        .error{
            color: brown;
        }
    </style>
</head>
    <h1>Formulario de Suscripción</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($nombre) ?>">
        <?php if (isset($errores['nombre'])): ?>
            <span class="error"><?= htmlspecialchars($errores['nombre']) ?></span>
        <?php endif; ?>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($direccion) ?>">
        <?php if (isset($errores['direccion'])): ?>
            <span class="error"><?= htmlspecialchars($errores['direccion']) ?></span>
        <?php endif; ?><br><br>

        <label for="suscripcion">Tipo de suscripción:</label>
        <input type="radio" name="suscripcion" value="mensual" <?= $suscripcion === 'mensual' ? 'checked' : '' ?>> Mensual
        <input type="radio" name="suscripcion" value="trimestral" <?= $suscripcion === 'trimestral' ? 'checked' : '' ?>> Trimestral
        <?php if (isset($errores['suscripcion'])): ?>
            <span class="error"><?= htmlspecialchars($errores['suscripcion']) ?></span>
        <?php endif; ?><br><br>

        <label for="generos">Géneros:</label>
        <?php foreach ($generos as $genero): ?>
            <input type="checkbox" name="generos[]" value="<?= $genero['genero_id'] ?>" <?= isset($generosSeleccionados) && in_array($genero['genero_id'], $generosSeleccionados) ? 'checked' : '' ?>> <?= $genero['nombre'] ?><br>
        <?php endforeach; ?>
        <?php if (isset($errores['generos'])): ?>
            <span class="error"><?= htmlspecialchars($errores['generos']) ?></span>
        <?php endif; ?>

        <br><br>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
