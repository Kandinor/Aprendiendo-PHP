<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once './base_datos/conexion.php';

// Consulta para obtener todos los artículos
$select = $db->prepare("SELECT * FROM ARTICULOS");
$select->execute();
$articulos = $select->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Artículos slug</title>
</head>
<body>
    <h1>Lista de Artículos</h1>
    <button><a href="crear_articulo.php">Crear nuevo artículo</a></button>
    <ul>
        <?php foreach ($articulos as $articulo): ?>
            <li>
                <a href="detalle_articulos.php?slug=<?php echo htmlspecialchars($articulo['slug']); ?>">
                    <?php echo htmlspecialchars($articulo['TITULO'] ?? 'Título no disponible'); ?>
                </a>
            </li>
            
        <?php endforeach; ?>
    </ul>
</body>
</html>
