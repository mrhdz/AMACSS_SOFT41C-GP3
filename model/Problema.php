<?php
class Problema {
    private $id;
    private $id_cancha;
    private $id_usuario;
    private $descripcion;
    private $fecha_reporte;
    private $estado;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getIdCancha() { return $this->id_cancha; }
    public function setIdCancha($id_cancha) { $this->id_cancha = $id_cancha; }

    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getFechaReporte() { return $this->fecha_reporte; }
    public function setFechaReporte($fecha_reporte) { $this->fecha_reporte = $fecha_reporte; }

    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { $this->estado = $estado; }
}