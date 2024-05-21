<?php
$urbanizacion = new Urbanizacion();
$casa=new Casa();

if(file_exists(FILE_NAME)){
    $urbanizacion->cargarCasasEnUrba();
}

if (isset($_POST['guardar'])) {
    if ($casa = new Casa(
        clean_input($_POST['metros']),
        clean_input($_POST['habitaciones']),
        clean_input($_POST['precio']),
        isset($_POST['guardar'])
    )) {
        if(empty($casa->getErrores())){
            $urbanizacion->agregarCasa($casa);
            $urbanizacion->guardarCasaEnUrba();
            header('Location: index.php');
            die();
        }
        
    };
}

function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
