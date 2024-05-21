
<?php
abstract class Alerta {
    protected $titulo;
    protected $mensaje;

    public function __construct($titulo, $mensaje) {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
    }

    abstract public function mostrar();
}
