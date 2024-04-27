<?php
spl_autoload_register(function ($class_name) {
    include 'src/' . $class_name . '.php';
});

//SI SEPONE EL AUTOLOAD NO SE PONBE REQUIAR
