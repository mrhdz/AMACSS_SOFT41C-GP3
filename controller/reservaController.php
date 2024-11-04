<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/conexion.php');
class ReservaController extends conexion {

    public function crearReserva($reserva) {
        // Consulta SQL para insertar una nueva reserva
        $sql = "INSERT INTO reservas (id_cancha, id_usuario, fecha_reserva, duracion, estado) VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la sentencia
        if ($stmt = $this->cn()->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("iisis", 
                $reserva->getIdCancha(), 
                $reserva->getIdUsuario(), 
                $reserva->getFechaReserva(), 
                $reserva->getDuracion(), 
                $reserva->getEstado()
            );

            // Ejecutar la sentencia
            if ($stmt->execute()) {
                // Cerrar la declaración
                $stmt->close();
                return true; // Reserva creada exitosamente
            } else {
                // Ocurrió un error al ejecutar la consulta
                return false;
            }
        } else {
            // Ocurrió un error al preparar la consulta
            return false;
        }
    }
    public function listarReservasPorUsuario($idUsuario) {
        // Consulta SQL para obtener las reservas del usuario
        $sql = "SELECT r.id_reserva, r.id_cancha, r.fecha_reserva, r.duracion, r.estado, c.nombre AS cancha_nombre 
                FROM reservas r
                INNER JOIN canchas c ON r.id_cancha = c.id_cancha
                WHERE r.id_usuario = ?";

        // Preparar la sentencia
        if ($stmt = $this->cn()->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("i", $idUsuario);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener resultados
            $result = $stmt->get_result();
            $reservas = $result->fetch_all(MYSQLI_ASSOC);

            // Cerrar la declaración
            $stmt->close();

            return $reservas; // Retornar las reservas
        } else {
            // Ocurrió un error al preparar la consulta
            return false;
        }
    }
    public function eliminarReserva($idReserva) {
        // Consulta SQL para eliminar la reserva
        $sql = "DELETE FROM reservas WHERE id_reserva = ?";
        
        // Preparar la sentencia
        if ($stmt = $this->cn()->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("i", $idReserva);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Cerrar la declaración
                $stmt->close();
                return true; // Reserva eliminada exitosamente
            } else {
                // Ocurrió un error al ejecutar la consulta
                return false;
            }
        } else {
            // Ocurrió un error al preparar la consulta
            return false;
        }
    }
    public function actualizarReserva($idReserva, $fecha, $duracion, $estado) {
        // Consulta SQL para actualizar una reserva existente
        $sql = "UPDATE reservas SET fecha_reserva = ?, duracion = ?, estado = ? WHERE id_reserva = ?";
        
        // Preparar la sentencia
        if ($stmt = $this->cn()->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("siis", $fecha, $duracion, $estado, $idReserva);
    
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                // Cerrar la declaración
                $stmt->close();
                return true; // Reserva actualizada exitosamente
            } else {
                // Ocurrió un error al ejecutar la consulta
                return false;
            }
        } else {
            // Ocurrió un error al preparar la consulta
            return false;
        }
    }
    class ReservaController extends conexion {
    public function listarTodasLasReservas() {
        $sql = "SELECT r.id_reserva, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, r.fecha_reserva, r.duracion, r.estado 
                FROM reservas r 
                JOIN usuarios u ON r.id_usuario = u.id_usuario 
                JOIN canchas c ON r.id_cancha = c.id_cancha";
        $result = $this->cn()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarReserva($idReserva, $fecha, $duracion, $estado) {
        $sql = "UPDATE reservas SET fecha_reserva = ?, duracion = ?, estado = ? WHERE id_reserva = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("sisi", $fecha, $duracion, $estado, $idReserva);
        return $stmt->execute();
    }

    public function eliminarReserva($idReserva) {
        $sql = "DELETE FROM reservas WHERE id_reserva = ?";
        $stmt = $this->cn()->prepare($sql);
        $stmt->bind_param("i", $idReserva);
        return $stmt->execute();
    }
        public function listarTodasLasReservas() {
            $sql = "SELECT r.id_reserva, u.nombre AS usuario_nombre, c.nombre AS cancha_nombre, r.fecha_reserva, r.duracion, r.estado 
                    FROM reservas r 
                    JOIN usuarios u ON r.id_usuario = u.id_usuario 
                    JOIN canchas c ON r.id_cancha = c.id_cancha";
            $result = $this->cn()->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    
        public function actualizarReserva($idReserva, $fecha, $duracion, $estado) {
            $sql = "UPDATE reservas SET fecha_reserva = ?, duracion = ?, estado = ? WHERE id_reserva = ?";
            $stmt = $this->cn()->prepare($sql);
            $stmt->bind_param("sisi", $fecha, $duracion, $estado, $idReserva);
            return $stmt->execute();
        }
    
        public function eliminarReserva($idReserva) {
            $sql = "DELETE FROM reservas WHERE id_reserva = ?";
            $stmt = $this->cn()->prepare($sql);
            $stmt->bind_param("i", $idReserva);
            return $stmt->execute();
        }
    
    
}

?>