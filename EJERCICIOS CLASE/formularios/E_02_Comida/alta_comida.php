<?php 
$errores = [];
$nombre= "";
$direccion= "";
$platos= "";
$vegetariano= "";
$alergias_posibles = [
    "lacteos" => false,
    "gluten" => false,
    "pescado" => false,
    "huevos" => false,
    "frutos_secos"=> false,
    "soja" => false,
    
];



if(isset($_POST["enviar"])){
    $nombre=$_POST["nombre"];
    $direccion=$_POST["direccion"];
    $platos = $_POST["platos"];
    $vegetariano=$_POST["vegetariano"];
    $alergias = $_POST["alergias"];


    //Validaciones
    if(empty($nombre)){
        $errores["nombre"]="*El nombre es obligatorio";
    }
    if(empty($direccion)){
        $errores["direccion"]="*La direccion es obligatoria";
    }
    if(empty($platos) || !is_numeric($platos) || $platos <=0){
        $errores["platos"]="*El número de plato no es válido";
    }

    if(empty($vegetariano)){
        $errores["vegetariano"] = "*Debes seleccionar si eres vegetariano o no";
    }

    // if(!isset($_POST["alergias"]) || empty($_POST["alergias"])){
    //     $errores["alergias"] = "*Debes seleccionar al menos una alergia";
    // }

    //si no hay errores
    if(empty($errores)){
        header("location: exito.php");
        die();
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
        .etiqueta{
            display: block;
        }

        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="nombre" class="etiqueta">nombre:</label>
        <input type="text" name="nombre" value="<?=$nombre?>">
        <?php
            if(isset($errores["nombre"])){
                echo "<span class='error'>{$errores['nombre']}</span>";
            }
        ?>
        <label for="direccion" class="etiqueta">Dirección:</label>
        <input type="text" name="direccion" value="<?=$direccion?>">
        <?php
            if(isset($errores["direccion"])){
                echo "<span class='error'>{$errores['direccion']}</span>";
            }
        ?>
    
        <label for="platos" class="etiqueta">Numero de platos:</label>
        <input type="number" name="platos" value="<?=$platos?>">
        <?php
            if(isset($errores["platos"])){
                echo "<span class='error'>{$errores['platos']}</span>";
            }
        ?><br><br>

        <label for="vegetariano">¿eres vegetariano?:</label>
        <select name="vegetariano" value="<?=$vegetariano?>">
            <option value="si">si</option>
            <option value="no" selected>no</option>
        </select>
        <?php
            if(isset($errores["vegetariano"])){
                echo "<span class='error'>{$errores['vegetariano']}</span>";
            }
        ?>
        <br><br>
        

        <label>¿Qué alergias tienes?</label><br>
        <?php foreach ($alergias_posibles as $key => $value) 
        ?>
        <input type="checkbox" name="alergias[]" value="ninguna">
        <label for="ninguna">ninguna</label><br>

        <input type="checkbox" name="alergias[]" value="gluten">
        <label for="gluten">Gluten</label><br>

        <input type="checkbox" name="alergias[]" value="lactosa">
        <label for="lactosa">Lactosa</label><br>

        <input type="checkbox"  name="alergias[]" value="mani">
        <label for="mani">Maní</label><br>

        <input type="checkbox"  name="alergias[]" value="mariscos">
        <label for="mariscos">Mariscos</label><br>

        <input type="checkbox"  name="alergias[]" value="soja">
        <label for="soja">Soja</label><br>

        <input type="checkbox"name="alergias[]" value="huevos">
        <label for="huevos">Huevos</label><br>

        <input type="checkbox"  name="alergias[]" value="frutos-secos">
        <label for="frutos-secos">Frutos secos</label><br>

        <input type="checkbox"  name="alergias[]" value="pescado">
        <label for="pescado">Pescado</label><br>

        <input type="checkbox" name="alergias[]" value="tomate">
        <label for="tomate">Tomate</label><br>

        <input type="checkbox" name="alergias[]" value="polen">
        <label for="polen">Polen</label><br>

        <input type="checkbox" name="alergias[]" value="acaros">
        <label for="acaros">Ácaros</label><br>

        <input type="checkbox"  name="alergias[]" value="leche">
        <label for="leche">Leche</label><br>

        <input type="checkbox"  name="alergias[]" value="cacahuetes">
        <label for="cacahuetes">Cacahuetes</label><br>

        <input type="checkbox"  name="alergias[]" value="crustaceos">
        <label for="crustaceos">Crustáceos</label><br>

        <input type="checkbox"  name="alergias[]" value="mostaza">
        <label for="mostaza">Mostaza</label>
        <?php
            if(isset($errores["alergias"])){
                echo "<span class='error'>{$errores['alergias']}</span>";
            }
        ?><br> 


        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>