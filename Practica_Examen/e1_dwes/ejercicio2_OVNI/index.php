<?php
include 'autoload.php';

function leerCSV($filename) {
    $avistamientos = [];
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if (count($data) < 8) {
                continue; // Salta las líneas que no tienen todos los campos necesarios
            }
            $cadena = implode(';', $data);
            $avistamiento = new Avistamiento('', '', '', '', null);
            $avistamiento->cargarInfo($cadena);
            $avistamientos[] = $avistamiento;
        }
        fclose($handle);
    } else {
        echo "Error al abrir el archivo $filename.";
    }
    return $avistamientos;
}

$avistamientos = leerCSV('avistamientos.csv');

if ($avistamientos) {
    foreach ($avistamientos as $avistamiento) {
        echo $avistamiento->pintarHTML();
    }
} else {
    echo "No se encontraron avistamientos.";
}

