<?php
//variables
$cadena ='';
$errores = [];

if(isset($_GET['enviar'])){

    if(isset($_GET['cadena']) && $_GET['cadena'] != ""){
        $cadena = $_GET['cadena'];
    }else{
        $errores[] = "*Debe ingresar una cadena";
    }

    if(empty($errores)){
        $cadena = strtolower($cadena);
        $cadena = str_replace(" ", "", $cadena);
        
        if($cadena == strrev($cadena)){
            echo "La cadena es palindromo";
        }else{
            echo "La cadena no es palindromo";
        }

        

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manejo de cadena Palindromo</title>
</head>
<body>
    <form action="" method="get">
        <label for="">Ingrese una cadena</label>
        <input type="text" name="cadena" value="">

        <input type="submit" value="Enviar">
    </form>

    <div class="resultado">

    </div>
</body>
</html>