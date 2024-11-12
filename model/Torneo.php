<?php
class Torneo {
    private $id;
    private $nombre;
    private $fecha;
    private $id_cancha;
    private $id_usuario;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }

    public function getIdCancha() { return $this->id_cancha; }
    public function setIdCancha($id_cancha) { $this->id_cancha = $id_cancha; }

    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }
}