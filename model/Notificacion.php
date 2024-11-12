<?php
class Notificacion {
    private $id;
    private $id_usuario;
    private $mensaje;
    private $fecha;
    private $leida;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }

    public function getMensaje() { return $this->mensaje; }
    public function setMensaje($mensaje) { $this->mensaje = $mensaje; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }

    public function getLeida() { return $this->leida; }
    public function setLeida($leida) { $this->leida = $leida; }
}