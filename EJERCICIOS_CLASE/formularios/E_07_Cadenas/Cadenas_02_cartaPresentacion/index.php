<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta presentacion</title>
</head>
<body>
    <form action="" method="get">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= $nombre?>" placeholder="Nombre completo">

        <label for="empresa">Empresa:</label>
        <input type="text" name="empresa" value="<?= $empresa?>">

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" value="<?= $fecha?>">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>