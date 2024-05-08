<?php

class Casa
{
    public string $metros;
    public string $habitaciones;
    public string $precio;

    private array $errores = [];


    public function __construct(string $metros = '', string $habitaciones = '', string $precio = '', bool $formularioEnviado = false)
    {
        $this->metros = $metros;
        $this->habitaciones = $habitaciones;
        $this->precio = $precio;

        if($formularioEnviado){
            $this->validarDatos();
        }
    }

    public function pintarFormulario(): string
    {
        $html = "<form action='' method='post'>
            <label>Metros:<input type='text' name='metros' value='" . $this->metros. "'></label>";

        if (!empty($this->errores['metros'])) {
            $html .= "<span style='color: red;'>{$this->errores['metros']}</span>";
        }

        $html .= "<br>
            <label>Habitaciones:<input type='text' name='habitaciones' value='" . $this->habitaciones . "'></label>";

        if (!empty($this->errores['habitaciones'])) {
            $html .= "<span style='color: red;'>{$this->errores['habitaciones']}</span>";
        }

        $html .= "<br>
            <label>Precio:<input type='text' name='precio' value='" . $this->precio . "'></label>";

        if (!empty($this->errores['precio'])) {
            $html .= "<span style='color: red;'>{$this->errores['precio']}</span>";
        }

        $html .= "<br>
            <input type='submit' name='guardar' value='Registrar Casa'>
        </form>";

        return $html;
    }

    public function validarDatos()
    {
        if (empty($this->metros)) {
            $this->errores['metros'] = 'El campo no puede estar vacío';
        }
        if (empty($this->habitaciones)) {
            $this->errores['habitaciones'] = 'El campo no puede estar vacío';
        }
        if (empty($this->precio)) {
            $this->errores['precio'] = 'El campo no puede estar vacío';
        }
    }
    function pintarFila():string{
        return "<tr><td>$this->metros</td>
                    <td>$this->habitaciones</td>
                    <td>$this->precio</td>
                </tr>";
    }
    public function getErrores(): array
    {
        return $this->errores;
    }
}
