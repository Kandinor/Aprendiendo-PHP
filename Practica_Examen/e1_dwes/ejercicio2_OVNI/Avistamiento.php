<?php
class Avistamiento {
    private $localizacion;
    private $fecha;
    private $hora;
    private $notas;
    private $ovni;

    public function __construct($localizacion, $fecha, $hora, $notas, $ovni) {
        $this->localizacion = $localizacion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->notas = $notas;
        $this->ovni = $ovni;
    }

    public function pintarHTML() {
        return "<div>Avistamiento en $this->localizacion el $this->fecha a las $this->hora. Notas: $this->notas<br>" . $this->ovni->pintarHTML() . "</div>";
    }

    public function cargarInfo($cadena) {
        $data = explode(';', $cadena);
        $this->localizacion = $data[0];
        $this->fecha = $data[1];
        $this->hora = $data[2];
        $this->notas = $data[3];
        $tipo = $data[4];
        $velocidad = $data[5];
        $camuflaje = $data[6];
        $extra = $data[7];

        switch ($tipo) {
            case 'disco':
                $this->ovni = new DiscoVolador($velocidad, $camuflaje, $extra);
                break;
            case 'cigarro':
                $this->ovni = new Cigarro($velocidad, $camuflaje, $extra);
                break;
            case 'luz':
                $this->ovni = new LuzMisteriosa($velocidad, $camuflaje, $extra);
                break;
        }
    }
}
