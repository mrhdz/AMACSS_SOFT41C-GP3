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

    public function obtenerReservasUsuario($usuarioId) {
        $sql = "SELECT r.*, c.nombre as cancha_nombre 
                FROM reservas r 
                JOIN canchas c ON r.id_cancha = c.id_cancha 
                WHERE r.id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function listarSolicitudesPendientes() {
        $sql = "SELECT r.*, c.nombre AS cancha_nombre, u.nombre AS usuario_nombre 
                FROM reservas r 
                JOIN canchas c ON r.id_cancha = c.id_cancha 
                JOIN usuarios u ON r.id_usuario = u.id_usuario 
                WHERE r.estado = 'pendiente'";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function aprobarReserva($idReserva) {
        $sql = "UPDATE reservas SET estado = 'confirmada' WHERE id_reserva = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idReserva);
        $result = $stmt->execute();

        if ($result) {
            $this->agregarHistorial($idReserva, "Reserva aprobada");
        }

        return $result;
    }

    public function rechazarReserva($idReserva) {
        $sql = "UPDATE reservas SET estado = 'cancelada' WHERE id_reserva = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idReserva);
        $result = $stmt->execute();

        if ($result) {
            $this->agregarHistorial($idReserva, "Reserva rechazada");
        }

        return $result;
    }

    private function agregarHistorial($idReserva, $cambio) {
        $sql = "INSERT INTO historialReservas (id_reserva, fecha_modificacion, cambio) VALUES (?, NOW(), ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("is", $idReserva, $cambio);
        return $stmt->execute();
    }

    public function obtenerHistorialReservas() {
        $sql = "SELECT * FROM historialReservas ORDER BY fecha_modificacion DESC";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>