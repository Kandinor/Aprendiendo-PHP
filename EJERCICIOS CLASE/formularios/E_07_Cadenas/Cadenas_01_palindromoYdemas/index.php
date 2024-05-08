<?php
// Variables
$cadena = '';
$errores = [];
$resultados = [];

function contarVocales($cadena) {
    return preg_match_all('/[aeiouáéíóú]/i', $cadena);
}

function contarConsonantes($cadena) {
    return preg_match_all('/[bcdfghjklmnpqrstvwxyz]/i', $cadena);
}

function esPalindromo($cadena) {
    $limpio = str_replace(' ', '', strtolower($cadena));
    return $limpio === strrev($limpio) ? 'sí' : 'no';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cadena'])) {
    if (trim($_GET['cadena']) !== "") {
        $cadena = $_GET['cadena'];
        $resultados['vocales'] = contarVocales($cadena);
        $resultados['consonantes'] = contarConsonantes($cadena);
        $resultados['palindromo'] = esPalindromo($cadena);
    } else {
        $errores[] = "*Debe ingresar una cadena.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Cadena</title>
</head>
<body>
    <form action="" method="get">
        <label for="cadena">Ingrese una cadena:</label>
        <input type="text" name="cadena" id="cadena" value="<?php echo htmlspecialchars($cadena); ?>">
        <input type="submit" value="Enviar">
    </form>

    <?php if (!empty($errores)): ?>
        <div class="errores">
            <?php foreach ($errores as $error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($resultados)): ?>
        <div class="resultado">
            <ul>
                <li>Número de vocales: <?php echo $resultados['vocales']; ?></li>
                <li>Número de consonantes: <?php echo $resultados['consonantes']; ?></li>
                <li>Palíndromo: <?php echo $resultados['palindromo']; ?></li>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>
