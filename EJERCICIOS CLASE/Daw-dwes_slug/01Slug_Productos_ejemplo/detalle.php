<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['slug'])) {
    if ($_GET['slug'] == 'producto-1') {
        $mensaje = 'Así pasa el tiempo';
    } else if ($_GET['slug'] == 'producto-2') {
        $mensaje = 'Tengo hambre';
    } else if ($_GET['slug'] == 'producto-3') {
        $mensaje = 'akuna matata o patata?';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= isset($mensaje) ? $mensaje : '' ?>
</body>

</html>