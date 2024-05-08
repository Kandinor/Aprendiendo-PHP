<?php
define ('FILE_NAME', 'urbanizacion.json');

class Urbanizacion{
    private array $urbanizacion;
    
    public function __construct(){
        $this->urbanizacion = [];
    }

    function cargarCasasEnUrba(string $archivo=FILE_NAME):void{
        $casasTemporales = json_decode(file_get_contents($archivo));
        foreach($casasTemporales as $casaT){
            $this->urbanizacion[] = new Casa(
                $casaT->metros,
                $casaT->habitaciones,
                $casaT->precio
            );
        }

    }

    function guardarCasaEnUrba(string $archivo=FILE_NAME):void{
        file_put_contents($archivo, json_encode($this->urbanizacion));
    }

    function agregarCasa(Casa $nuevaCasa):void{
        $this->urbanizacion[] = $nuevaCasa;
    }

    function pintarTabla():string{
        $html = "<table>
                <tr>
                    <th>Metros</th>
                    <th>Habitaciones</th>
                    <th>Precio</th>
                </tr>";
        foreach($this->urbanizacion as $casa) {
            $html .= $casa->pintarFila();    
        }
        $html .= "</table>";
        return $html;
    }
}
?>