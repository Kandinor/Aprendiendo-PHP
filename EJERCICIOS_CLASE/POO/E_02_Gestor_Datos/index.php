<?php
// index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
spl_autoload_register(function ($class_name) {
    $path = "src/" . $class_name . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
});

// Instancias y uso de clases
$gestores = [
    new GestorRelacional("MySQL", "Gestor de base de datos relacional", ["Linux", "Windows"], "8.0", true),
    new GestorNoRelacional("MongoDB", "Gestor de base de datos no relacional", "document"),
    new GestorBasadoEnFichero("ArchivoTexto", "Gestor basado en ficheros", "TXT", "ambos")
];

foreach ($gestores as $gestor) {
    $gestor->renderHTML();
}
