<?php
include_once 'reserva.php';
include '../../model/conexion.php';

class ReservaController {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearReserva($reserva) {
        $sql = "INSERT INTO reservas (id_cancha, id_usuario, fecha_reserva, duracion, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iisis", $reserva->getIdCancha(), $reserva->getIdUsuario(), $reserva->getFechaReserva(), $reserva->getDuracion(), $reserva->getEstado());
        return $stmt->execute();
    }

    public function obtenerReservaPorId($id) {
        $sql = "SELECT * FROM reservas WHERE id_reserva = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarReserva($reserva) {
        $sql = "UPDATE reservas SET id_cancha = ?, id_usuario = ?, fecha_reserva = ?, duracion = ?, estado = ? WHERE id_reserva = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iisisi", $reserva->getIdCancha(), $reserva->getIdUsuario(), $reserva->getFechaReserva(), $reserva->getDuracion(), $reserva->getEstado(), $reserva->getIdReserva());
        return $stmt->execute();
    }

    public function eliminarReserva($id) {
        $sql = "DELETE FROM reservas WHERE id_reserva = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
