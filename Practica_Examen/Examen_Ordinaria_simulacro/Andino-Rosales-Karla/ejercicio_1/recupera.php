<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_GET['token'];
    $new_password = $_POST['password'];

    if (empty($token) || empty($new_password)) {
        die("Token o contraseña vacíos.");
    }

    $query = $db->prepare("SELECT usuario_id FROM tokens WHERE token = :token AND fecha_validez > NOW() AND consumido = 0");
    $query->bindParam(':token', $token, PDO::PARAM_STR);
    $query->execute();
    $token_data = $query->fetch(PDO::FETCH_ASSOC);

    if ($token_data) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = $db->prepare("UPDATE usuarios SET pass = :pass WHERE id = :id");
        $update_query->bindParam(':pass', $hashed_password, PDO::PARAM_STR);
        $update_query->bindParam(':id', $token_data['usuario_id'], PDO::PARAM_INT);
        $update_query->execute();

        $consume_token_query = $db->prepare("UPDATE tokens SET consumido = 1 WHERE token = :token");
        $consume_token_query->bindParam(':token', $token, PDO::PARAM_STR);
        $consume_token_query->execute();

        echo "Contraseña actualizada correctamente.";
    } else {
        die("Token inválido o caducado.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <!-- formulario para recuperar contraseña -->
    <form action="recupera.php?token=<?= htmlspecialchars($_GET['token']) ?>" method="post">
        <label for="password">Nueva Contraseña</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
