<?php
class Cancha {
    private $id_cancha;
    private $id_propietario;
    private $nombre;
    private $tipo;
    private $capacidad;
    private $descripcion;
    private $precio;
    private $urlImagen;
    
    // Constructor actualizado
    public function __construct($id = null, $propietario = null, $nombre = "", $tipo = "", $capacidad = 0, $descripcion = "", $precio = 0.0, $urlImagen = "") {
        $this->id_cancha = $id;
        $this->id_propietario = $propietario;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->urlImagen = $urlImagen;
    }

    // Métodos getter
    public function getIdCancha() {
        return $this->id_cancha;
    }

    public function getIdPropietario() {
        return $this->id_propietario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCapacidad() {
        return $this->capacidad;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getUrlImagen() {
        return $this->urlImagen;
    }

    // Métodos setter
    public function setIdCancha($id) {
        $this->id_cancha = $id;
    }

    public function setIdPropietario($propietario) {
        $this->id_propietario = $propietario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setCapacidad($capacidad) {
        $this->capacidad = $capacidad;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setUrlImagen($urlImagen) {
        $this->urlImagen = $urlImagen;
    }
}
?>
