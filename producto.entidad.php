<?php
class Producto {
    private $id;
    private $Compania;
    private $Nombre;
    private $Precio;
    private $AnoLanzamiento;
    private $Generos;
    private $Plataformas;
    private $Imagen;

    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}