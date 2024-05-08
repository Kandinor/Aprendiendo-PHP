<?php
session_start(); //Se manda cookie, y si hay cookie carga la sesión.
//¿hay cookie?
$pagina_origen = isset($_SESSION['pagina_origen']) ? $_SESSION['pagina_origen'] : 'privada.php';

if(isset($_POST['secreto']) && $_POST['secreto'] == '1234'){
    $_SESSION['acceso'] = 1;
    header("Location: $pagina_origen");
    die();
    //ojo, aquí lo ideal es hacer un redirect to, para que así cuando una vez que te ha mandado de vuelta después me redirija desde desde donde estaba para buena navegabilidad.  Para no hacerlo a privada, sino hacia donde haya venido.
}else{
    $_SESSION['acceso'] = 0; // las dos opciones son válidas
    unset($_SESSION['acceso']);
}

//esto viene después de una autentificación contra bd, donde habría que sacar la información del usuario (nombre, imagen de perfil, etc...), si el perfil es blanco o negro, todo eso se mete en la sesión.



//la autentificación, está estréchamente ligada al código que tenga para validarlo (privada); Como en $_SESSION protejo con = 1, pongo esta condición en auth.; 

// if(isset($_SESSION['cont'])){
//     $cont=$_SESSION['cont'];
// }else{
//     $cont= "no está establecida";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
</head>
<body>
    <h1>Autentifícate</h1>
    <form action ="auth.php" method="post">
        <input type="text" name="secreto" id="">
        <input type="submit" value="Enviar" name="enviar">
    </form>
    <p><?=$cont?></p>
</body>
</html>