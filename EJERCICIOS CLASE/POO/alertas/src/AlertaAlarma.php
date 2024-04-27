<?php
//require_once 'Alerta.php';

class AlertaAlarma extends Alerta {
    public function mostrar() {
        return "<div style='color: red;'><h1>{$this->titulo}</h1><p>AlertaAlarma{$this->mensaje}</p></div>";
        //poner el alert con un <scrip> alert(bla bla)</scrip>. pero no usarlo...
    }
}
