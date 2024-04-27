<?php
// Inicializar un array para almacenar mensajes de error
$errores = [];

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $anio_publicacion = $_POST['anio_publicacion'] ?? '';
    $numero_paginas = $_POST['numero_paginas'] ?? '';
    
    // Validar los datos (este es un ejemplo simple, puedes ampliar las validaciones)
    if (empty($titulo)) {
        $errores['titulo'] = 'El título es obligatorio.';
    }
    if (empty($autor)) {
        $errores['autor'] = 'El autor es obligatorio.';
    }
    if (!is_numeric($anio_publicacion) || $anio_publicacion < 0) {
        $errores['anio_publicacion'] = 'El año de publicación no es válido.';
    }
    if (!is_numeric($numero_paginas) || $numero_paginas <= 3) {
        $errores['numero_paginas'] = 'El número de páginas debe ser un número positivo.';
    }
    
    // Si no hay errores, procesar los datos (por ejemplo, guardarlos en una base de datos)
    if (count($errores) === 0) {
        // Aquí iría el código para guardar los datos en la base de datos
        
        // Realizar una redirección para evitar el reenvío del formulario
        header('Location: form_libro.php', true, 302);
        // die(); o exit
        exit;
    }
}

// Si hay errores o si el formulario no ha sido enviado, mostrar el formulario nuevamente
include 'form_libro.html'; // Asegúrate de que este archivo contenga el formulario HTML
