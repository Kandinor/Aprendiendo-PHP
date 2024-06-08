<!-- contendrá la conexión a la base de datos y las funciones CRUD. -->
<?php 
    define ("DB_DATA", "mysql:host=localhost;dbname=examen2");
    define ("USERNAME", "examen2");
    define ("PASSWORD" , "examen2");

    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//CUANDO HAY ERRORES SALTA EXCEPCION
    }catch(PDOException $e){
        echo "ERROR EN LA BASE DE DATOS:" . $e->getMessage();
        die();
    }
?>