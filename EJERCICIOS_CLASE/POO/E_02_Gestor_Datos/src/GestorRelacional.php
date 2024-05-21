<?php
/**Esta subclase tendrá atributos como sistemas operativos soportados, version, y soporteTransacciones. */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// src/GestorRelacional.php
require_once 'GestorDatos.php';
require_once 'HTMLRenderer.php';

class GestorRelacional extends GestorDatos {
    use HTMLRenderer;

    private $sistemasOperativos;
    private $version;
    private $soporteTransacciones;

    public function __construct($nombre, $descripcion, $sistemasOperativos, $version, $soporteTransacciones) {
        parent::__construct($nombre, $descripcion);
        $this->sistemasOperativos = $sistemasOperativos;
        $this->version = $version;
        $this->soporteTransacciones = $soporteTransacciones;
    }

    public function obtenerDetalle() {
        return "SOs soportados: " . implode(", ", $this->sistemasOperativos) .
                ", Versión: $this->version, Soporte de Transacciones: $this->soporteTransacciones";
    }
}

