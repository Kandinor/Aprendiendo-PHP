<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    $paths = [
        __DIR__ . '/',
        __DIR__ . '/classes/', // Si tus clases están en un subdirectorio llamado 'classes'
    ];

    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            include $file;
            return;
        }
    }
});

