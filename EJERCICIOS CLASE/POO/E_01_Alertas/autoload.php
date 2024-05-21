<?php
spl_autoload_register(function ($class_name) {
    include 'src/' . $class_name . '.php';
});

//SI SE PONE EL AUTOLOAD NO SE PONBE REQUIRE
