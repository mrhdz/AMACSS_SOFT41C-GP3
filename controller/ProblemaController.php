<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/Problema.php');

class ProblemaController {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=sportspace', 'root', '');
    }

    public function reportarProblema($id_cancha, $id_usuario, $descripcion) {
        $problema = new Problema();
        $problema->setIdCancha($id_cancha);
        $problema->setIdUsuario($id_usuario);
        $problema->setDescripcion($descripcion);

        $query = "INSERT INTO problemas (id_cancha, id_usuario, descripcion, fecha_reporte) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$problema->getIdCancha(), $problema->getIdUsuario(), $problema->getDescripcion()]);
    }

    public function obtenerProblemasCancha($id_cancha) {
        $query = "SELECT p.*, u.nombre as nombre_usuario FROM problemas p JOIN usuarios u ON p.id_usuario = u.id_usuario WHERE p.id_cancha = ? ORDER BY p.fecha_reporte DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_cancha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}