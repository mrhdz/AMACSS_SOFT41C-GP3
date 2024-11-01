<?php
include_once 'historialReserva.php';
include '../../model/conexion.php';

class HistorialReservaController {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearHistorial($historial) {
        $sql = "INSERT INTO historialReservas (id_reserva, fecha_modificacion, cambio) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iss", $historial->getIdReserva(), $historial->getFechaModificacion(), $historial->getCambio());
        return $stmt->execute();
    }

    public function obtenerHistorialPorId($id) {
        $sql = "SELECT * FROM historialReservas WHERE id_historial = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarHistorial($historial) {
        $sql = "UPDATE historialReservas SET id_reserva = ?, fecha_modificacion = ?, cambio = ? WHERE id_historial = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issi", $historial->getIdReserva(), $historial->getFechaModificacion(), $historial->getCambio(), $historial->getIdHistorial());
        return $stmt->execute();
    }

    public function eliminarHistorial($id) {
        $sql = "DELETE FROM historialReservas WHERE id_historial = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
