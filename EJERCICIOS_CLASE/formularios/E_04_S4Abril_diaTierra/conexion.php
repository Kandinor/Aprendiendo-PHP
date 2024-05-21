<?php
    /**
     * NB_DB 
     * CREATE USER 'alumno'@'localhost' IDENTIFIED BY 'Alumno123!';
     * cambié la contarseña a alumno con:
     * ALTER USER 'NB_USUARIO'@'localhost' IDENTIFIED BY 'nueva_contraseña';
     * FLUSH PRIVILEGES;
     */
    define ("DB_DATA", "mysql:host=localhost;dbname=ACCIONESDB");
    define ("USERNAME", "alumno");
    define ("PASSWORD" , "alumno");
    
    // function conexion() {
    //     try {
    //         $db = new PDO(DB_DATA, USERNAME, PASSWORD);
    //         return $db;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }

    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
    }catch(PDOException $e){
        echo "ERROR:" . $e->getMessage();
        die();
    }

?>