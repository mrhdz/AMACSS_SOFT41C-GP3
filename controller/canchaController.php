<?php
include_once 'cancha.php';
include '../../model/conexion.php';

class CanchaController {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function crearCancha($cancha) {
        $sql = "INSERT INTO canchas (id_propietario, nombre, tipo, capacidad, descripcion, precio, url, disponibilidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issisdss", $cancha->getIdPropietario(), $cancha->getNombre(), $cancha->getTipo(), $cancha->getCapacidad(), $cancha->getDescripcion(), $cancha->getPrecio(), $cancha->getUrl(), $cancha->getDisponibilidad());
        return $stmt->execute();
    }

    public function obtenerCanchaPorId($id) {
        $sql = "SELECT * FROM canchas WHERE id_cancha = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarCancha($cancha) {
        $sql = "UPDATE canchas SET id_propietario = ?, nombre = ?, tipo = ?, capacidad = ?, descripcion = ?, precio = ?, url = ?, disponibilidad = ? WHERE id_cancha = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issisdssi", $cancha->getIdPropietario(), $cancha->getNombre(), $cancha->getTipo(), $cancha->getCapacidad(), $cancha->getDescripcion(), $cancha->getPrecio(), $cancha->getUrl(), $cancha->getDisponibilidad(), $cancha->getIdCancha());
        return $stmt->execute();
    }

    public function eliminarCancha($id) {
        $sql = "DELETE FROM canchas WHERE id_cancha = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
