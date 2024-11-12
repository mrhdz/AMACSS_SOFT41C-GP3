<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/Notificacion.php');

class NotificacionController {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=sportspace', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function crearNotificacion($id_usuario, $mensaje) {
        $notificacion = new Notificacion();
        $notificacion->setIdUsuario($id_usuario);
        $notificacion->setMensaje($mensaje);

        $query = "INSERT INTO notificaciones (id_usuario, mensaje, fecha) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$notificacion->getIdUsuario(), $notificacion->getMensaje()]);
    }

    public function obtenerNotificacionesUsuario($id_usuario) {
        $query = "SELECT * FROM notificaciones WHERE id_usuario = ? ORDER BY fecha DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarNotificacionesNoLeidas($id_usuario) {
        $query = "SELECT COUNT(*) FROM notificaciones WHERE id_usuario = ? AND leida = 0";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchColumn();
    }

    public function obtenerNotificacionesAdmin($id_usuario) {
        // Assuming admin notifications are for all users or have a specific admin user ID
        $query = "SELECT * FROM notificaciones ORDER BY fecha DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function marcarComoLeida($id_notificacion) {
        $query = "UPDATE notificaciones SET leida = 1 WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_notificacion]);
    }
}
