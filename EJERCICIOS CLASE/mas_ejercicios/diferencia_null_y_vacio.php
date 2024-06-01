<?php
$variable1 = null;
$variable2 = "";

if (is_null($variable1)) {
    echo "\$variable1 es null<br>";
} else {
    echo "\$variable1 no es null<br>";
}

if ($variable2 === "") {
    echo "\$variable2 es una cadena vacía<br>";
} else {
    echo "\$variable2 no es una cadena vacía<br>";
}

if (empty($variable1)) {
    echo "\$variable1 está vacía o es null<br>";
} else {
    echo "\$variable1 no está vacía<br>";
}

if (empty($variable2)) {
    echo "\$variable2 está vacía o es null<br>";
} else {
    echo "\$variable2 no está vacía<br>";
}
?>

<!-- Conclusión
null: Se utiliza para variables no inicializadas o para indicar la ausencia de valor.
Vacío (""): Indica que una cadena de texto está presente pero sin contenido.
En la validación de formularios, debes usar isset() para verificar si la variable está definida y !empty() para asegurarte de que no esté vacía. -->