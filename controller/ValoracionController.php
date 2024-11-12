<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/Valoracion.php');

class ValoracionController {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=sportspace', 'root', '');
    }

    public function agregarValoracion($id_cancha, $id_usuario, $puntuacion, $comentario) {
        $valoracion = new Valoracion();
        $valoracion->setIdCancha($id_cancha);
        $valoracion->setIdUsuario($id_usuario);
        $valoracion->setPuntuacion($puntuacion);
        $valoracion->setComentario($comentario);

        $query = "INSERT INTO valoraciones (id_cancha, id_usuario, puntuacion, comentario) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$valoracion->getIdCancha(), $valoracion->getIdUsuario(), $valoracion->getPuntuacion(), $valoracion->getComentario()]);
    }

    public function obtenerValoracionPromedio($id_cancha) {
        $query = "SELECT AVG(puntuacion) as promedio FROM valoraciones WHERE id_cancha = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_cancha]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return round($resultado['promedio'], 1);
    }

    public function obtenerValoracionesCancha($id_cancha) {
        $query = "SELECT v.*, u.nombre as nombre_usuario FROM valoraciones v JOIN usuarios u ON v.id_usuario = u.id_usuario WHERE v.id_cancha = ? ORDER BY v.fecha DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_cancha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}