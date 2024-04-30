<?php 

/**-------1. configuracion de variables-------*/
define('NUM_COLUMNS', 3); // para tres columnas ordenables: PAIS, RESULTADO_TIPO y RESULTADO_VALOR
define('NUM_ELEM_POR_PAG', 3); // Número de partidos por página

$orderby = isset($_GET['orderby']) && is_numeric($_GET['orderby']) && $_GET['orderby'] <= NUM_COLUMNS ? $_GET['orderby'] : 1;
$order = isset($_GET['order']) && $_GET['order'] === "DESC" ? 'DESC' : 'ASC';
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

/**-------2. Conexión a la Base de Datos y Consulta-------*/
//revisar si puedo hacer funciones en el archivo conexion.php
try {
    $db = new PDO('mysql:host=localhost;dbname=RUGBY', 'RUGBY', 'RUGBY');
    $sql = "SELECT ID, PAIS, RESULTADO_TIPO, RESULTADO_VALOR FROM RESULTADOS ORDER BY $orderby $order LIMIT :limite OFFSET :offset";
    $consulta = $db->prepare($sql);
    $consulta->bindValue(':limite', NUM_ELEM_POR_PAG, PDO::PARAM_INT);
    $consulta->bindValue(':offset', NUM_ELEM_POR_PAG * ($page - 1), PDO::PARAM_INT);
    $consulta->execute();
    $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Obtener el total de registros para la paginación
    $consulta_count = $db->query("SELECT COUNT(ID) FROM RESULTADOS");
    $count = $consulta_count->fetchColumn();
    $num_pages = ceil($count / NUM_ELEM_POR_PAG);
} catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage();
    die();
}

/**-------3. Función para Generar Consultas de Ordenación
 * para generar dinámicamente los enlaces para ordenar las columnas en la tabla-------*/

function generateQueryString($orderapintar, $orderby, $order) {
    $neworder = ($order == "ASC" && $orderapintar == $orderby) ? "DESC" : "ASC";
    return "?orderby=$orderapintar&order=$neworder&page=1";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de resultados</title>
    <style>
        body {
            background-color: #ccc;
            color: black;
        }
        table {
            margin: auto;
        }
        table tr td a{
            color: white;
        }
        table, table td, table th{
            border: 1px solid grey;
            border-collapse: collapse;
            padding: 0.2em;
        }
        div.contenido {
            min-height: 110px;
        }
        div.paginacion a{
            text-decoration: none;
        }
        div.paginacion{
            margin: auto;
            text-align: center;
        }
        div.paginacion a.actual{
            font-weight: bold;
            color: blue;
        }
        a, a:visited {
            color: #F0F;
        }
    </style>
</head>
<body>

    <table>
        <thead>
        <tr>
            <th><a href="<?= generateQueryString('PAIS', $orderby, $order) ?>">País</a></th>
            <th><a href="<?= generateQueryString('RESULTADO_TIPO', $orderby, $order) ?>">Tipo de Resultado</a></th>
            <th><a href="<?= generateQueryString('RESULTADO_VALOR', $orderby, $order) ?>">Valor del Resultado</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos as $dato):?>
                <tr>
                    <td><?= $dato['PAIS']; ?></td>
                    <td><?= $dato['RESULTADO_TIPO'];?></td>
                    <td><?= $dato['RESULTADO_VALOR'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="paginacion">
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <a href="?page=<?= $i ?>&orderby=<?= $orderby ?>&order=<?= $order ?>" class="<?= ($i == $page) ? 'actual' : '' ?>"><?= $i ?></a>
        <?php } ?>
    </div>

</body>
</html>