<!-- Donde los usuarios pueden ver las publicaciones. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feed</title>
</head>
<body>
    <h1>feed-privada</h1>
    <a href="perfil.php">perfil</a>

    <form action="" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" placeholder="Escribe tu titulo">
        <label for="publicacion">Publicacion</label>
        <input type="text" name="publicacion" id="publicacion" placeholder="Escribe tu publicacion">
        <input type="submit" value="Publicar">
    </form>

    <div id="publicaciones" name="publicaciones">

    </div>
</body>
</html>