<?php 
//require_once 'Alerta.php';
// el autoload, cuando se llama a una clase que no existe, se llama a este archivo
// si la clase que se llama no existe, se llama a este archivo
//ejecuta la funcion que hemos definido
class AlertaWarning extends Alerta {
    public function mostrar() {
        return "<div style='color: orange;'><h1>{$this->titulo}</h1><p>AlertaWarning {$this->mensaje}</p></div>";
    }
}


