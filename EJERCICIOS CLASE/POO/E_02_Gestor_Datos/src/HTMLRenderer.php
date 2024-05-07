<?php
trait HTMLRenderer {
    public function renderHTML() {
        echo "<h1>{$this->nombre}</h1>";
        echo "<p>{$this->descripcion}</p>";
        echo "<p>{$this->obtenerDetalle()}</p>";
    }
}
