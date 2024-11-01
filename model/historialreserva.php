<?php
class HistorialReserva {
    private $id_historial;
    private $id_reserva;
    private $fecha_modificacion;
    private $cambio;
    
    public function __construct($id = "", $reserva = "", $fecha_modificacion = "", $cambio = "") {
        $this->id_historial = $id;
        $this->id_reserva = $reserva;
        $this->fecha_modificacion = $fecha_modificacion;
        $this->cambio = $cambio;
    }

    public function getIdHistorial() {
        return $this->id_historial;
    }

    public function getIdReserva() {
        return $this->id_reserva;
    }

    public function getFechaModificacion() {
        return $this->fecha_modificacion;
    }

    public function getCambio() {
        return $this->cambio;
    }

    public function setIdHistorial($id) {
        $this->id_historial = $id;
    }

    public function setIdReserva($reserva) {
        $this->id_reserva = $reserva;
    }

    public function setFechaModificacion($fecha_modificacion) {
        $this->fecha_modificacion = $fecha_modificacion;
    }

    public function setCambio($cambio) {
        $this->cambio = $cambio;
    }
}
?>
