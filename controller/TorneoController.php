<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/conexion.php');

class TorneoController {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerTodosLosTorneos() {
        $query = "SELECT t.*, c.nombre AS nombre_cancha, u.nombre AS nombre_usuario 
                  FROM torneos t 
                  LEFT JOIN canchas c ON t.id_cancha = c.id_cancha 
                  LEFT JOIN usuarios u ON t.id_usuario = u.id_usuario";
        $result = $this->conexion->ejecutarSQL($query);
        
        if ($result === false) {
            error_log("Error en la consulta SQL: " . $this->conexion->cn()->error);
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function crearTorneo($nombre, $fecha, $id_cancha, $id_usuario, $id_reserva) {
        $query = "INSERT INTO torneos (nombre, fecha, id_cancha, id_usuario, id_reserva) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->cn()->prepare($query);
        
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        
        $stmt->bind_param("ssiii", $nombre, $fecha, $id_cancha, $id_usuario, $id_reserva);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Torneo creado exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'Error al crear el torneo: ' . $stmt->error];
        }
    }

    public function unirseATorneo($id_torneo, $id_usuario) {
        $checkQuery = "SELECT * FROM participantes_torneo WHERE torneo_id = ? AND usuario_id = ?";
        $stmt = $this->conexion->cn()->prepare($checkQuery);
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        $stmt->bind_param("ii", $id_torneo, $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return ['success' => false, 'message' => 'Ya estás inscrito en este torneo.'];
        }
        
        $query = "INSERT INTO participantes_torneo (torneo_id, usuario_id) VALUES (?, ?)";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        $stmt->bind_param("ii", $id_torneo, $id_usuario);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Te has unido al torneo exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'Error al unirse al torneo: ' . $stmt->error];
        }
    }

    public function obtenerCanchasDisponiblesParaUsuario($id_usuario) {
        $query = "SELECT r.id_reserva, r.fecha_reserva, r.hora_inicio, r.hora_fin, c.id_cancha, c.nombre AS cancha_nombre
                  FROM reservas r
                  JOIN canchas c ON r.id_cancha = c.id_cancha
                  WHERE r.id_usuario = ? AND r.fecha_reserva >= CURDATE()
                  ORDER BY r.fecha_reserva, r.hora_inicio";
        
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            error_log("Error al preparar la consulta: " . $this->conexion->cn()->error);
            return false;
        }
        
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result === false) {
            error_log("Error en la consulta SQL: " . $this->conexion->cn()->error);
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerTorneosCreados($id_usuario) {
        $query = "SELECT t.*, c.nombre AS nombre_cancha 
                  FROM torneos t 
                  LEFT JOIN canchas c ON t.id_cancha = c.id_cancha 
                  WHERE t.id_usuario = ?
                  ORDER BY t.fecha DESC";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            error_log("Error al preparar la consulta: " . $this->conexion->cn()->error);
            return false;
        }
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result === false) {
            error_log("Error en la consulta SQL: " . $this->conexion->cn()->error);
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerParticipantesTorneo($id_torneo) {
        $query = "SELECT u.id_usuario, u.nombre
                  FROM participantes_torneo pt 
                  JOIN usuarios u ON pt.usuario_id = u.id_usuario 
                  WHERE pt.torneo_id = ?";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            error_log("Error al preparar la consulta: " . $this->conexion->cn()->error);
            return false;
        }
        $stmt->bind_param("i", $id_torneo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result === false) {
            error_log("Error en la consulta SQL: " . $this->conexion->cn()->error);
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function editarTorneo($id_torneo, $nombre, $fecha) {
        $query = "UPDATE torneos SET nombre = ?, fecha = ? WHERE id = ?";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        $stmt->bind_param("ssi", $nombre, $fecha, $id_torneo);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Torneo actualizado exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'Error al actualizar el torneo: ' . $stmt->error];
        }
    }

    public function eliminarTorneo($id_torneo) {
        // Primero, eliminar los participantes del torneo
        $query = "DELETE FROM participantes_torneo WHERE torneo_id = ?";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        $stmt->bind_param("i", $id_torneo);
        $stmt->execute();

        // Luego, eliminar el torneo
        $query = "DELETE FROM torneos WHERE id = ?";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        $stmt->bind_param("i", $id_torneo);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Torneo eliminado exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'Error al eliminar el torneo: ' . $stmt->error];
        }
    }

    public function esOrganizadorTorneo($id_torneo, $id_usuario) {
        $query = "SELECT id FROM torneos WHERE id = ? AND id_usuario = ?";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            error_log("Error al preparar la consulta: " . $this->conexion->cn()->error);
            return false;
        }
        $stmt->bind_param("ii", $id_torneo, $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->num_rows > 0;
    }

    public function eliminarParticipante($id_torneo, $id_usuario, $id_organizador) {
        if (!$this->esOrganizadorTorneo($id_torneo, $id_organizador)) {
            return ['success' => false, 'message' => 'No tienes permiso para eliminar participantes de este torneo.'];
        }

        $query = "DELETE FROM participantes_torneo WHERE torneo_id = ? AND usuario_id = ?";
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error al preparar la consulta: ' . $this->conexion->cn()->error];
        }
        $stmt->bind_param("ii", $id_torneo, $id_usuario);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Participante eliminado exitosamente.'];
        } else {
            return ['success' => false, 'message' => 'Error al eliminar el participante: ' . $stmt->error];
        }
    }

    public function obtenerTorneosPorCancha($id_cancha) {
        $query = "SELECT t.id, t.nombre, t.fecha, r.hora_inicio, r.hora_fin, u.nombre AS nombre_organizador
                  FROM torneos t
                  JOIN reservas r ON t.id_reserva = r.id_reserva
                  JOIN usuarios u ON t.id_usuario = u.id_usuario
                  WHERE t.id_cancha = ?
                  ORDER BY t.fecha ASC, r.hora_inicio ASC";
        
        $stmt = $this->conexion->cn()->prepare($query);
        if ($stmt === false) {
            error_log("Error al preparar la consulta: " . $this->conexion->cn()->error);
            return false;
        }
        
        $stmt->bind_param("i", $id_cancha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result === false) {
            error_log("Error en la consulta SQL: " . $this->conexion->cn()->error);
            return false;
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}