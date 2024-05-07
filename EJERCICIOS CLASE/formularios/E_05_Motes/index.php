<!-- formulario para guardar los datop de los empleados  -->

<?php 


//variables
$empleados_csv = file('empleados.csv');
$nombre = '';
$departamento = '';
$mote = '';
$errores = [];

//validar
if(isset($_POST["guardar"])){
    if(isset($_POST["nombre"]) && $_POST["nombre"] != ""){
        $nombre = $_POST["nombre"];
    }else{
        $errores ["nombre"]= "*El nombre es obligatorio";
    }

    if(isset($_POST["departamento"]) && $_POST["departamento"] != ""){
        $departamento = $_POST["departamento"];
    }else{
        $errores ["departamento"]= "*El departamento es obligatorio";
    }

    if(isset($_POST["mote"]) && $_POST["mote"] != ""){
        $mote = $_POST["mote"];
    }else{
        $errores ["mote"]= "*El mote es obligatorio";
    }

    if(empty($errores)){
        $empleados_csv = strtolower($name) . ';' . implode(';', $empleado) . PHP_EOL;
        file_put_contents('empleados.csv', $empleados_csv, FILE_APPEND);
        
        header('Location: index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <style>
        h1{
            text-align: center;
        }
        form{
            width: 400px;
            margin: 0 auto;
        }
        input{
            width: 100%;
        }
        span{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Agrega los empleados</h1>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" value="<?=$nombre?>">
        <?php if(isset($errores['nombre'])): ?>
            <span style="color:red"> <?=$errores['nombre']?> </span><br> 
        <?php endif; ?>

        Departamento: <input type="text" name="departamento" value ="<?=$departamento?>">
        <?php if(isset($errores['departamento'])): ?>
            <span style="color:red"> <?=$errores['departamento']?> </span><br> 
        <?php endif; ?>

        mote: <input type="text" name="mote" value="<?=$mote?>">
        <?php if(isset($errores['mote'])): ?>
            <span style="color:red"> <?=$errores['mote']?> </span><br>
        <?php endif; ?>
        <br><br>

        <input type="submit" name ="guardar" value="Guardar">
    </form>
    
</body>
</html>