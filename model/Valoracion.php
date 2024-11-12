<?php
class Valoracion {
    private $id;
    private $id_cancha;
    private $id_usuario;
    private $puntuacion;
    private $comentario;
    private $fecha;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getIdCancha() { return $this->id_cancha; }
    public function setIdCancha($id_cancha) { $this->id_cancha = $id_cancha; }

    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }

    public function getPuntuacion() { return $this->puntuacion; }
    public function setPuntuacion($puntuacion) { $this->puntuacion = $puntuacion; }

    public function getComentario() { return $this->comentario; }
    public function setComentario($comentario) { $this->comentario = $comentario; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
}