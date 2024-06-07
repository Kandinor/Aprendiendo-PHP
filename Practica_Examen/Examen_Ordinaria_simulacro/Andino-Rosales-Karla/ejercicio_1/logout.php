<?php
session_start();
//primero destruirla
session_destroy();
//asi especifico la sesion
unset($_SESSION["usuario"]);

header("Location: login.php");
die();

