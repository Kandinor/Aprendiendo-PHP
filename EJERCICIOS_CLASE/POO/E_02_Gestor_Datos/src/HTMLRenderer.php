<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
trait HTMLRenderer {
    public function renderHTML() {
        echo "<h1>{$this->nombre}</h1>";
        echo "<p>{$this->descripcion}</p>";
        echo "<p>{$this->obtenerDetalle()}</p>";
    }
}
