aut:proceso por el cual el usuario dice que es el 

autorizacion: despues de loguearse vemos que permisos tiene ej: profe puede hacer mas que alumno


Sesion
1. base de datos
2. contraseña HASH NO txt claro Funciones: 
               1. pass_verify 
               2. pass_hash
    PHP fucniones: session_start
                    por debajo trabaja con una cookie especial y genera array asso $_SESSION (podemos establecer info y que permanezca entre peticiones (otra pagina))

                    seesion_destroy

                    header Location

Recuerdame:
1. BD con tokens: una vez que se autentifique aunque sea con recuerdame se hace una session

[singelton bbdd](https://github.com/JorgeDuenasLerin/PHP-Acceso-a-datos/blob/master/src/DWESBaseDatos.php)

spl_autoload_register 

tarea para mejorar el codigo: hacer una funcion para guardar el array de errore y solopintar con la key

```
Ejemplo de Código para Registrar Usuarios con Contraseñas Hasheadas

php

if (isset($_POST['registrar'])) {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : null;
    
    if (empty($nombre) || empty($contrasena)) {
        // Añadir manejo de errores apropiado aquí
    } else {
        // Hashear la contraseña antes de guardarla en la base de datos
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
        
        // Insertar el usuario en la base de datos con la contraseña hasheada
        $stmt = $db->ejecuta("INSERT INTO usuarios (nombre, pass) VALUES (?, ?)", [$nombre, $contrasenaHash]);
        
        if ($stmt) {
            // Redirigir al usuario o mostrar un mensaje de éxito
        } else {
            // Mostrar un error
        }
    }
}
```

