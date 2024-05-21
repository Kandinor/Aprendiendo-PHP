<?php

    define ("DB_DATA", "mysql:host=localhost;dbname=ARTICULOS_slug;charset=utf8");
    define ("USERNAME", "alumno");
    define ("PASSWORD" , "alumno");

    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        echo "Conexión exitosa!!!!!!"; // Temporalmente para verificar la conexión

    }catch(PDOException $e){
        echo "ERROR en conexión a la base de datos:" . $e->getMessage();
        die();
    }

