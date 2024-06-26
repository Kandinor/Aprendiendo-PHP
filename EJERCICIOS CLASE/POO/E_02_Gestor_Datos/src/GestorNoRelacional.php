<?php
/**Incluirá atributos como tipoModeloDatos (por ejemplo, document, key-value, graph, etc.). */
ini_set('display_errors', 1);
error_reporting(E_ALL);
// src/GestorNoRelacional.php
require_once 'GestorDatos.php';
require_once 'HTMLRenderer.php';

class GestorNoRelacional extends GestorDatos {
    use HTMLRenderer;
    private $tipoModeloDatos;

    public function __construct($nombre, $descripcion, $tipoModeloDatos) {
        parent::__construct($nombre, $descripcion);
        $this->tipoModeloDatos = $tipoModeloDatos;
    }

    public function obtenerDetalle() {
        return "Tipo de Modelo de Datos: $this->tipoModeloDatos";
    }
}
