<?php
//require_once 'Alerta.php';

class AlertaError extends Alerta {
    public function mostrar() {
        return "<div style='color: blue;'><h1>{$this->titulo}</h1><p>AlertaError{$this->mensaje}</p></div>";
    }
}
