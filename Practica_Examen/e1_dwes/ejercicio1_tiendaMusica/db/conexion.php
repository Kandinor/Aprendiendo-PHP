<?php 
    define ("DB_DATA", "mysql:host=localhost;dbname=examen1");
    define ("USERNAME", "examen1");
    define ("PASSWORD" , "examen1");

    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "ERROR EN LA BASE DE DATOS:" . $e->getMessage();
        die();
    }
?>