<?php
//cuidado con no poner etiqueta de php
require 'autoload.php';

$tipos = ['AlertaWarning', 'AlertaError', 'AlertaAlarma'];

define("CANTIDAD", 10);

for ($i = 0; $i < CANTIDAD; $i++) {
    $tipoAleatorio = $tipos[array_rand($tipos)];
    $alerta = new $tipoAleatorio("Título $i", "Mensaje $i");//SE PUEDE SUSTITUIR POR CONDICIONAL
    echo $alerta->mostrar();
}
