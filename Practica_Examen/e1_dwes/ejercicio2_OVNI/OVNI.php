<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
abstract class OVNI {
    protected $velocidad;
    protected $camuflaje;

    public function __construct($velocidad, $camuflaje) {
        $this->velocidad = $velocidad;
        $this->camuflaje = $camuflaje;
    }

    abstract public function pintarHTML();
    abstract public function cargarInfo($cadena);
}

