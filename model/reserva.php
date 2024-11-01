<?php
class Reserva {
    private $id_reserva;
    private $id_cancha;
    private $id_usuario;
    private $fecha_reserva;
    private $duracion;
    private $estado;
    
    public function __construct($id = "", $cancha = "", $usuario = "", $fecha = "", $duracion = 0, $estado = "confirmada") {
        $this->id_reserva = $id;
        $this->id_cancha = $cancha;
        $this->id_usuario = $usuario;
        $this->fecha_reserva = $fecha;
        $this->duracion = $duracion;
        $this->estado = $estado;
    }

    public function getIdReserva() {
        return $this->id_reserva;
    }

    public function getIdCancha() {
        return $this->id_cancha;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getFechaReserva() {
        return $this->fecha_reserva;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setIdReserva($id) {
        $this->id_reserva = $id;
    }

    public function setIdCancha($cancha) {
        $this->id_cancha = $cancha;
    }

    public function setIdUsuario($usuario) {
        $this->id_usuario = $usuario;
    }

    public function setFechaReserva($fecha) {
        $this->fecha_reserva = $fecha;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
}
?>