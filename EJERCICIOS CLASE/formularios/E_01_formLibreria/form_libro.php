<?php
$errores = [];
$titulo = "";
$autor ="";
$anio_publicacion="";
$numero_paginas = "";

//if the user submited the form
if(isset($_POST["enviar"])){

    // if there are form errors
    // fill errors array
    if (isset($_POST["titulo"]) && $_POST["titulo"] != ""){
        $titulo= $_POST["titulo"]; 
    }else {
        $errores["titulo"] = "*Este campo es oblogatorio!";
    }
     /**Otra forma de hacerlo es asumiendo que todo esta bien y solo validar solo el error */
    $autor = $_POST['autor'];
    $anio_publicacion = $_POST['anio_publicacion'];
    $numero_paginas = $_POST['numero_paginas'];

    if(($_POST["autor"]) === ""){
        $errores["autor"] = '*El autor no es válido.';
    }

    if($_POST["anio_publicacion"] > date("Y") || $_POST["anio_publicacion"] === "" ||!is_numeric($anio_publicacion)) {
        $errores["anio_publicacion"] = '*El año de publicación no es válido.';
    }
    
    if($_POST["numero_paginas"] < 3 || $_POST["numero_paginas"] === "" || !is_numeric($numero_paginas)) {
        $errores["numero_paginas"] = '*El número de páginas no es válido, debe ser mayor que 3.';
    }
    
    //si no hay errores
    if(empty($errores)){
        header("Location: exito.php");
        die(); //OJO SIEMPRE  PONER o exit;
        /*esto lo que hace es que cuando estamos en un area autentificada, el die no permite que siga procesando la pagina */
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label{
            display: block;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h1>ALTA DE LIBRO</h1>
    <form action="" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?=$titulo?>">
        <?php
            if(isset($errores["titulo"])){
                // echo "<span class='error'>".$errores["titulo"]."</span>";
                echo "<span class='error'>{$errores['titulo']}</span>";
            }
        ?>
        <!-- value para la percistencia de datos -->
        <br><br>
        <label for="autor">autor:</label>
        <input type="text"  name="autor" value="<?=$autor?>">
        <?php
            if(isset($errores["autor"])){
                echo "<span class='error'>{$errores['autor']}</span>";
            }
        ?>
        <br><br>

        <label for="anio_publicacion">año de publicacion :</label>
        <input type="text"  name="anio_publicacion" value="<?=$anio_publicacion?>">
        <?php
            if(isset($errores["anio_publicacion"])){
                echo "<span class='error'>{$errores['anio_publicacion']}</span>";
            }
        ?>
        <br><br>

        <label for="numero_paginas">numero de paginas:</label>
        <input type="text"  name="numero_paginas" value="<?=$numero_paginas?>">
        <?php
            if(isset($errores["numero_paginas"])){
                echo "<span class='error'>{$errores['numero_paginas']}</span>";
            }
        ?>
        <br><br>

        <input type="submit" name="enviar" value="Enviar">
</body>
</html>