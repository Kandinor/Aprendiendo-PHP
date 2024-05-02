<!-- Donde los usuarios pueden ver las publicaciones. -->
<?php 
//me conecto a la base de datos
require_once 'Conexion.php';
session_start();
$errores =[];
$errores_delete = [];

if(isset($_GET["good"])){
    if ($_GET["good"] == "perfe"){
        $mensaje = "Publicación eliminada con éxito";
    }
}

if(isset($_POST["borrar"])){
    try{
        $query = "DELETE FROM PUBLICACIONES WHERE ID = :id";
        $delete = $db->prepare($query);
        $delete->bindParam(":id", $_POST["id"]);
        $delete->execute();
    } catch (exception $e){
        $errores_delete[] = $e->getMessage();
    }
    
    header("Location: feed-privada.php?good=perfe&id=" . urlencode($_POST["id"]));
}

//validacion
if(isset($_POST["enviar"])){

    if (isset($_POST["publicacion"]) && $_POST["publicacion"]) {
        $publicacion = $_POST["publicacion"];
        
    } else {
        $errores[] = "*La publicación no puede estar vacía";
    }
    

    //SI NO HAY ERRORES
    if(empty($errores)){
        try{
            // Preparar la sentencia SQL para insertar datos OJO CON LOS NOMBRES DE LAS TABLAS
            $insert = $db->prepare("INSERT INTO PUBLICACIONES(USUARIO_ID, PUBLICACION, FECHA) VALUES (:usuario_id, :publicacion, NOW())");
            $insert->bindParam(":usuario_id", $_SESSION["usuario"]["ID"], PDO::PARAM_INT);
            $insert->bindParam(":publicacion", $publicacion);
            $insert->execute();
            $insert_id = $db->lastInsertId();
        
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
}

    //CONSULTA para mostrar las publicaciones
function mostrarPublicaciones(){
    global $db;
    $select =$db->prepare("SELECT * FROM USUARIOS, PUBLICACIONES WHERE USUARIOS.ID = PUBLICACIONES.USUARIO_ID ORDER BY FECHA DESC");
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feed</title>
</head>
<body>
    <h1>feed-privada</h1>
    <a href="perfil.php">perfil</a><br><br>

    <form action="" method="post">
        <label for="publicacion">Publicacion</label>
        <input type="text" name="publicacion" id="publicacion" placeholder="Escribe tu publicacion">

        <input type="submit" name=enviar value="Publicar">
    </form>

    <div id="publicaciones" name="publicaciones">
        <h3>Publicaciones</h3>
        <?= $errores_delete[0] ?? ""?>
        <?= $mensaje ?? ""?>
        <?php foreach(mostrarPublicaciones() as $row):?>
            <div id = publicacion>
                <strong><?php echo $row['NOMBRE'];?></strong> <?php echo $row['FECHA'];?>
                <p><?php echo htmlspecialchars($row['PUBLICACION']);?></p>
            </div>
            <div>
                <form method="post">
                    <input type="text" name="id" value="<?= htmlspecialchars($row['ID']); ?>" hidden>
                    <button type="submit" name="borrar">Borrar</button>
                </form>
            </div>
        <?php endforeach;?>

    </div>
</body>
</html>