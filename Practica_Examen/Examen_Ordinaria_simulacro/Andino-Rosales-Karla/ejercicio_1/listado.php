<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$limit = 3; // Número de pedidos por página
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$query = $db->prepare("SELECT pedidos.id, flores.nombre, pedidos.direccion, pedidos.fecha, pedidos.unidades 
                        FROM pedidos 
                        JOIN flores ON pedidos.flor_id = flores.id 
                        ORDER BY pedidos.fecha ASC
                        LIMIT :limit OFFSET :offset");
$query->bindParam(':limit', $limit, PDO::PARAM_INT);
$query->bindParam(':offset', $offset, PDO::PARAM_INT);
$query->execute();
$pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

$total_pedidos = $db->query("SELECT COUNT(*) FROM pedidos")->fetchColumn();
$total_pages = ceil($total_pedidos / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div id="contenedor">
        <h1>Listado de pedidos</h1>
        <a href="logout.php">Cerrar sesión</a>
        <table>
            <tr>
                <th>Id</th>
                <th>Dirección</th>
                <th>Fecha</th>
                <th>Unidades</th>
            </tr>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= htmlspecialchars($pedido['id']) ?></td>
                <td><?= htmlspecialchars($pedido['direccion']) ?></td>
                <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                <td><?= htmlspecialchars($pedido['unidades']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- Paginación -->
        <div>
            <?php if ($page > 1): ?>
                <a href="listado.php?page=<?= $page - 1 ?>">Anterior</a>
            <?php endif; ?>
            <?php if ($page < $total_pages): ?>
                <a href="listado.php?page=<?= $page + 1 ?>">Siguiente</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
