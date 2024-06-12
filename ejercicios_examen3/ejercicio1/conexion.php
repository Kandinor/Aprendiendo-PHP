<?php 
    define ("DB_DATA", "mysql:host=localhost;dbname=examen");
    define ("USERNAME", "examen");
    define ("PASSWORD" , "examen");

    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "ERROR EN LA BASE DE DATOS:" . $e->getMessage();
        die();
    }
?>