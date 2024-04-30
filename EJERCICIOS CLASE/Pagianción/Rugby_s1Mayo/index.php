<?php 
/**
 * 0. exijo la conexion a la bbdd
 * 1. tipo de odenacion
 * 1. hago la select para mostrar y prueba con print_r
 */

require_once 'conexion.php';

// Ordenación
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'PAIS';
$dir = isset($_GET['dir']) && strtolower($_GET['dir']) === 'desc' ? 'DESC' : 'ASC';

// Consulta inicial
$select =$db->prepare("SELECT * FROM RESULTADOS");
$select->execute();
$resultados = $select->fetchAll(PDO::FETCH_ASSOC);
// print_r($resultados);



$errores=[];
$pais = "";
$resultado_tipo = "";
$resultado_valor = "";

if(isset($_POST['enviar'])){

    if(isset($_POST['pais']) && $_POST['pais'] != ""){
        $pais = $_POST['pais'];
    } else {
        $errores['pais'] = "*Este campo es obligatorio";
    }

    if(isset($_POST['resultado_tipo']) && $_POST['resultado_tipo'] != ""){
        $resultado_tipo = $_POST['resultado_tipo'];
    } else {
        $errores['resultado_tipo'] = "*Selecciona el tipo de resultado";
    }

    if(isset($_POST['resultado_valor']) && $_POST['resultado_valor'] != ""){
        $resultado_valor = $_POST['resultado_valor'];
    } else {
        $errores['resultado_valor'] = "*Itroduce el resultado del partido";
    }

    //SI NO HAY ERRORES
    if(empty($errores)){
        try{
            // Preparar la sentencia SQL para insertar datos
            $insert = $db->prepare("INSERT INTO RUGBY(PAIS, RESULTADO_TIPO, RESULTADO_VALOR) VALUES (:PAIS, :RESULTADO_TIPO, :RESULTADO_VALOR)");

            //Vincular parámetros
            $insert->bindParam(':PAIS', $pais);
            $insert->bindParam(':RESULTADO_TIPO',$resultado_tipo);
            $insert->bindParam(':RESULTADO_VALOR',$resultado_valor);

            // Ejecutar la sentencia
            $insert->execute();

        }catch (PDOException $e) {
            // En caso de error en la base de datos, agregarlo a los errores
            $errores['db'] = "Error en la base de datos: " . $e->getMessage();
        }

        header("Location: listado_resultados.php");
        die(); 

    }else{
        $errores["consulta"] = "Error en el formulario";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form Partido</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .etiqueta{
            display: block;
        }
        input{
            margin-bottom: 10px;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <form action="index.php" method="POST">

        <label for="pais" class="etiqueta">País:</label>
        <input type="text" name="pais" value="<?=$pais?>" placeholder="Intruce el Pais">
        <?php if(isset($errores['pais'])): ?>
            <span class="error"><?php echo $errores['pais']; ?></span><br>
        <?php endif; ?><br>

        <label for="victoria">Victoria</label>
        <input type="radio" name="resultado_tipo" id="victoria" value="Victoria" <?php echo ($resultado_tipo === "Victoria") ? 'checked' : ''; ?>>
        <label for="empate">Empate</label>
        <input type="radio" name="resultado_tipo" id="empate" value="Empate" <?php echo ($resultado_tipo === "Empate") ? 'checked' : ''; ?>>
        <label for="derrota">Derrota</label>
        <input type="radio" name="resultado_tipo" id="derrota" value="Derrota" <?php echo ($resultado_tipo === "Derrota") ? 'checked' : ''; ?>>
        <?php if(isset($errores['resultado_tipo'])): ?>
            <span class="error"><?php echo $errores['resultado_tipo']; ?></span><br>
        <?php endif; ?><br><br>

        <label for="resultado_valor" class="etiqueta">Resultado del Partido:</label>
        <input type="text" name="resultado_valor"  value="<?=$resultado_valor?>" placeholder="ej: 60-40">
        <?php if(isset($errores['resultado_valor'])): ?>
            <span class="error"><?php echo $errores['resultado_valor']; ?></span><br>
        <?php endif; ?><br><br>

        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>