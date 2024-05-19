<?php

    define ("DB_DATA", "mysql:host=localhost;dbname=ACCIONESDB");
    define ("USERNAME", "alumno");
    define ("PASSWORD" , "alumno");

    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
    }catch(PDOException $e){
        echo "ERROR:" . $e->getMessage();
        die();
    }
