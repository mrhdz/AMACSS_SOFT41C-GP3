<?php
class FAQ {
    private $id;
    private $pregunta;
    private $respuesta;
    private $id_usuario;
    private $id_usuario_respuesta;
    private $fecha_creacion;
    private $fecha_respuesta;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getPregunta() { return $this->pregunta; }
    public function setPregunta($pregunta) { $this->pregunta = $pregunta; }

    public function getRespuesta() { return $this->respuesta; }
    public function setRespuesta($respuesta) { $this->respuesta = $respuesta; }

    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }

    public function getIdUsuarioRespuesta() { return $this->id_usuario_respuesta; }
    public function setIdUsuarioRespuesta($id_usuario_respuesta) { $this->id_usuario_respuesta = $id_usuario_respuesta; }

    public function getFechaCreacion() { return $this->fecha_creacion; }
    public function setFechaCreacion($fecha_creacion) { $this->fecha_creacion = $fecha_creacion; }

    public function getFechaRespuesta() { return $this->fecha_respuesta; }
    public function setFechaRespuesta($fecha_respuesta) { $this->fecha_respuesta = $fecha_respuesta; }
}