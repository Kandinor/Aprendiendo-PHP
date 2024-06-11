<?php 
class LuzMisteriosa extends OVNI {
    private $duracion;

    public function __construct($velocidad, $camuflaje, $duracion) {
        parent::__construct($velocidad, $camuflaje);
        $this->duracion = $duracion;
    }

    public function pintarHTML() {
        return "<div>Luz Misteriosa - Velocidad: $this->velocidad, Camuflaje: $this->camuflaje, Duración: $this->duracion</div>";
    }

    public function cargarInfo($cadena) {
        $data = explode(';', $cadena);
        $this->velocidad = $data[0];
        $this->camuflaje = $data[1];
        $this->duracion = $data[2];
    }
}
