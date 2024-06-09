<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
//conexion base de datos
require_once 'conexion.php';

session_start();

if(isset($_GET['token'])){

    $token = $_GET['token'];

    //1. comprobar si está consumido el token
    $query= $db -> prepare("SELECT * FROM auth_tokens WHERE token = :token");
    $query->bindParam(':token', $token);
    $query->execute();
    $token_data = $query->fetch(PDO::FETCH_ASSOC);
    // var_dump($token_data);

    if($token_data['consumido'] == 1){
        // echo "hola0";
        $query = $db -> prepare("SELECT email FROM usuarios WHERE id = :id");
        $query -> bindParam(':id', $token_data['id_user_consumido']);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        var_dump($user);

        if($user){
            $_SESSION['email'] = $user['email'];
            header('Location: privada.php');
            die();
        }
    }

    //2. si el token no está consumido
    else if($token_data['consumido'] == 0){
        
        if(isset($_POST['enviar'])){

            $email = $_POST['email'];
            $token = $_POST['token'];

            //1. registrar email en bbdd
            $query = $db->prepare("INSERT INTO usuarios (email) VALUES (:email)");
            $query->bindParam(':email', $email);
            $query->execute();

            //Devuelve el ID de la última fila insertada 
            $id_user_consumido = $db->lastInsertId();

            //2. asociar un token a ese email (actualizar tabla auth_tokens)
            $query = $db -> prepare("UPDATE auth_tokens SET id_user_consumido = :id_user_consumido, consumido = 1 WHERE token = :token");

            $query -> bindParam(':id_user_consumido', $id_user_consumido);
            $query -> bindParam(':token', $token);
            $query->execute();


            //GENERAR LOS 5 TOKENS
            for ($i = 0; $i < 5; $i++) {
                $nuevo_token = bin2hex(random_bytes(16));
                $query = "INSERT INTO auth_tokens (token, id_user_generador) VALUES (:token, :id_user)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':token', $nuevo_token);
                $stmt->bindParam(':id_user', $id_user_consumido);
                $stmt->execute();
            }

            //5. Iniciar sesión y redirigir
            $_SESSION['email'] = $email;
            header('Location: privada.php');
            die();

        }

    }

}else{
    echo "Token no proporcionado";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auth</title>
</head>
<body>
    <h1>Verifica token y registra al usuario</h1>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="hidden" name="token"  value="<?= $token?>">
        <input type="submit" value="Registrar" name="enviar">
    </form>
</body>
</html>