<!-- clase base -->
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
abstract class GestorDatos{
    protected $nombre;
    protected $descripcion;

    public function __construct(){
        $this -> nombre;
        $this -> descripcion;
    }

    abstract public function obtenerDetalle();
    
}