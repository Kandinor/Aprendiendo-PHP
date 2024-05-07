<!-- clase base -->
<?php
abstract class GestorDatos{
    protected $nombre;
    protected $descripcion;

    public function __construct(){
        $this -> nombre;
        $this -> descripcion;
    }

    abstract public function obtenerDetalles();
    
}