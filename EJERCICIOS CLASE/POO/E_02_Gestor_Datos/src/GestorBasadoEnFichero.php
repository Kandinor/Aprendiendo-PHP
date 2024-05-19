<?php 
/**Tendrá atributos como formatoArchivo (por ejemplo, TXT, CSV, XML) y modoAcceso (lectura, escritura, ambos). */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// src/GestorBasadoEnFichero.php
require_once 'GestorDatos.php';
require_once 'HTMLRenderer.php';

class GestorBasadoEnFichero extends GestorDatos {
    use HTMLRenderer;
    private $formatoArchivo;
    private $modoAcceso;

    public function __construct($nombre, $descripcion, $formatoArchivo, $modoAcceso) {
        parent::__construct($nombre, $descripcion);
        $this->formatoArchivo = $formatoArchivo;
        $this->modoAcceso = $modoAcceso;
    }

    public function obtenerDetalle() {
        return "Formato de Archivo: $this->formatoArchivo, Modo de Acceso: $this->modoAcceso";
    }
}
