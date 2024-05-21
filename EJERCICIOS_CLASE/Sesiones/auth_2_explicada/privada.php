<?php
// $_SERVER['REQUEST_URI'] contiene la parte de la URL después del nombre de dominio.
//al hacer sesion start, genera una nueva cookie. Las cookies se establecen por dominio, por lo que estará la cookie en cada página.
session_start();
$_SESSION['pagina_origen'] = $_SERVER['REQUEST_URI'];
//cada vez que se visite privada, si está establecida en la sesión el contador, sumame una.
//la primera vez que visitan tienen establecido el contador a cero y sino le vamos incrementando uno.

if(!isset($_SESSION['acceso'])|| $_SESSION['acceso'] != 1){
    header("Location: auth.php");
    die(); //die asegura que se detenga inmediatamente después de enviar la cabecera de redirección evitando cualquier procesamiento adicional.
}
//la autentificación, está estréchamente ligada al código que tenga para validarlo (privada); Como en $_SESSION protejo con != 1, pongo esta condición en auth como =1.

// if(isset($_SESSION['cont'])){
//     $_SESSION['cont']++;
// }else{
//     $_SESSION['cont'] = 0;
// }

// $cont = $_SESSION['cont'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privada</title>
</head>
<body>
    <h1>Área Privada</h1>
    <h3>Bienvenida</h3>
    <p>Contenido secreto</p>
    <p><?=$cont?></p>
</body>
</html>

