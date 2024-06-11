<?php 
class DiscoVolador extends OVNI {
    private $radio;

    public function __construct($velocidad, $camuflaje, $radio) {
        parent::__construct($velocidad, $camuflaje);
        $this->radio = $radio;
    }

    public function pintarHTML() {
        return "<div>Disco Volador - Velocidad: $this->velocidad, Camuflaje: $this->camuflaje, Radio: $this->radio</div>";
    }

    public function cargarInfo($cadena) {
        $data = explode(';', $cadena);
        $this->velocidad = $data[0];
        $this->camuflaje = $data[1];
        $this->radio = $data[2];
    }
}
