<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
//conexion base de datos
require_once 'conexion.php';

if (!isset($_GET['token'])) {
    die("Token no proporcionado.");
}

// Verificar si el token es válido y no ha sido consumido
$query = "SELECT * FROM auth_tokens WHERE token = :token AND consumido = 0";
$stmt = $db->prepare($query);
$stmt->bindParam(':token', $token);
$stmt->execute();
$token_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$token_data) {
    // Si el token ya está consumido, redirigir al área privada
    $query = "SELECT id_user_consumido FROM auth_tokens WHERE token = :token";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $token_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($token_data) {
        $_SESSION['email'] = obtenerEmailUsuario($token_data['id_user_consumido'], $db);
        header("Location: privada.php");
        exit;
    } else {
        die("Token inválido.");
    }
}

// Solicitar el email al usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];

    // Crear el usuario
    $query = "INSERT INTO usuarios (email) VALUES (:email)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $id_usuario = $db->lastInsertId();

    // Actualizar el token
    $query = "UPDATE auth_tokens SET id_user_consumido = :id_user, consumido = 1 WHERE token = :token";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_user', $id_usuario);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    // Generar 5 nuevos tokens
    for ($i = 0; $i < 5; $i++) {
        $nuevo_token = bin2hex(random_bytes(16));
        $query = "INSERT INTO auth_tokens (token, id_user_generador) VALUES (:token, :id_user)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':token', $nuevo_token);
        $stmt->bindParam(':id_user', $id_usuario);
        $stmt->execute();
    }

    // Iniciar sesión y redirigir al área privada
    $_SESSION['email'] = $email;
    header("Location: privada.php");
    exit;
}

function obtenerEmailUsuario($id_usuario, $db) {
    $query = "SELECT email FROM usuarios WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id_usuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return $usuario ? $usuario['email'] : null;
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
        <input type="hidden" name="token"  value="<?= htmlspecialchars($token) ?>">
        <input type="submit" value="Registrar">
    </form>
</body>
</html>