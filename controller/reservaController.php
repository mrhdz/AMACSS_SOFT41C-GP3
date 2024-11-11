<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/conexion.php');

class ReservaController extends conexion {

    public function crearReserva($reserva) {
        $sql = "INSERT INTO reservas (id_cancha, id_usuario, fecha_reserva, hora_inicio, hora_fin, duracion, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $this->cn()->prepare($sql)) {
            $stmt->bind_param("iisssis", 
                $reserva->getIdCancha(), 
                $reserva->getIdUsuario(), 
                $reserva->getFechaReserva(),
                $reserva->getHoraInicio(),
                $reserva->getHoraFin(),    
                $reserva->getDuracion(), 
                $reserva->getEstado()
            );

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function listarReservasPorUsuario($idUsuario) {
        $sql = "SELECT r.id_reserva, r.id_cancha, r.fecha_reserva, r.duracion, r.hora_inicio, r.hora_fin, r.estado, 
                c.nombre AS cancha_nombre, u.nombre AS propietario_nombre
                FROM reservas r
                INNER JOIN canchas c ON r.id_cancha = c.id_cancha
                INNER JOIN usuarios u ON c.id_propietario = u.id_usuario
                WHERE r.id_usuario = ?";

        if ($stmt = $this->cn()->prepare($sql)) {
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $reservas = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $reservas;
        } else {
            return false;
        }
    }

    public function eliminarReserva($idReserva) {
        $sql = "DELETE FROM reservas WHERE id_reserva = ?";
        
        if ($stmt = $this->cn()->prepare($sql)) {
            $stmt->bind_param("i", $idReserva);
    
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actualizarReserva($idReserva, $fecha, $duracion, $estado) {
        $sql = "UPDATE reservas SET fecha_reserva = ?, duracion = ?, estado = ? WHERE id_reserva = ?";
        
        if ($stmt = $this->cn()->prepare($sql)) {
            $stmt->bind_param("sisi", $fecha, $duracion, $estado, $idReserva);
    
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function listarSolicitudesPendientes() {
        $sql = "SELECT r.*, c.nombre AS cancha_nombre, u.nombre AS usuario_nombre 
                FROM reservas r 
                JOIN canchas c ON r.id_cancha = c.id_cancha 
                JOIN usuarios u ON r.id_usuario = u.id_usuario 
                WHERE r.estado = 'pendiente'";
        
        $result = $this->cn()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function aprobarReserva($idReserva) {
        $sql = "UPDATE reservas SET estado = 'confirmada' WHERE id_reserva = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("i", $idReserva);
        
        if ($stmt->execute()) {
            $this->agregarHistorial($idReserva, "Reserva aprobada");
            return true;
        }
        return false;
    }

    public function rechazarReserva($idReserva) {
        $sql = "UPDATE reservas SET estado = 'cancelada' WHERE id_reserva = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("i", $idReserva);
        
        if ($stmt->execute()) {
            $this->agregarHistorial($idReserva, "Reserva rechazada");
            return true;
        }
        return false;
    }

    private function agregarHistorial($idReserva, $cambio) {
        $sql = "INSERT INTO historialReservas (id_reserva, fecha_modificacion, cambio) VALUES (?, NOW(), ?)";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("is", $idReserva, $cambio);
        $stmt->execute();
    }

    // Método para obtener el historial de reservas
    public function obtenerHistorialReservas() {
        $sql = "SELECT h.id_reserva, h.fecha_modificacion, h.cambio 
                FROM historialReservas h 
                ORDER BY h.fecha_modificacion DESC";
        
        $result = $this->cn()->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC); // Devuelve todos los registros en un array asociativo
        } else {
            return false; // Retorna false si no se obtienen resultados
        }
    }
}
?>
