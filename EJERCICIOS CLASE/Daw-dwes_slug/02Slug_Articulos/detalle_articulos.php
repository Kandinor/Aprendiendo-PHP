<?php
require_once 'base_datos/conexion.php';

$articulo = null;

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];

    $sql = "SELECT * FROM ARTICULOS WHERE slug = :slug";
    $consulta = $db->prepare($sql);
    $consulta->bindParam(':slug', $slug);
    $consulta->execute();
    $articulo = $consulta->fetch(PDO::FETCH_ASSOC);

    if(!$articulo){
        $mensaje_error = "Artículo no encontrado";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Artículo</title>
</head>
<body>
    <?php if ($articulo): ?>
        <h1><?= htmlspecialchars($articulo['TITULO']) ?></h1>
        <p><?= htmlspecialchars($articulo['CONTENIDO']) ?></p>
        <p>Publicado el: <?= htmlspecialchars($articulo['FECHA']) ?></p>
    <?php else: ?>
        <p><?= isset($mensaje_error) ? htmlspecialchars($mensaje_error) : "No se proporcionó un slug válido." ?></p>
    <?php endif; ?>
</body>
</html>
