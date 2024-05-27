<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    
    <form action="procesar.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
        <span class="error">Debe tener nombre</span>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" required>
        <span class="error">Debe tener fecha</span>
        <span class="error">Debe ser posterior a hoy</span>

        <label for="flor">Flor</label>
        <select name="flor" id="flor" required>
            <option value="1">Florinventada (10)</option>
            <option value="2">Florinventada2 (5)</option>
            <option value="3">Florinventada3 (15)</option>
        </select>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" id="cantidad" required>

        <span class="error">Debe tener cantidad</span>
        <span class="error">No hay stock</span>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>