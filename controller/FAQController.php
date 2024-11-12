<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/FAQ.php');

class FAQController {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=sportspace', 'root', '');
    }

    public function agregarPregunta($pregunta, $id_usuario) {
        $faq = new FAQ();
        $faq->setPregunta($pregunta);
        $faq->setIdUsuario($id_usuario);

        $query = "INSERT INTO faq (pregunta, id_usuario, fecha_creacion) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$faq->getPregunta(), $faq->getIdUsuario()]);
    }

    public function agregarRespuesta($id_pregunta, $respuesta, $id_usuario) {
        $query = "UPDATE faq SET respuesta = ?, id_usuario_respuesta = ?, fecha_respuesta = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$respuesta, $id_usuario, $id_pregunta]);
    }

    public function obtenerTodasLasPreguntas() {
        $query = "SELECT f.*, u1.nombre as nombre_usuario_pregunta, u2.nombre as nombre_usuario_respuesta 
                  FROM faq f 
                  LEFT JOIN usuarios u1 ON f.id_usuario = u1.id_usuario 
                  LEFT JOIN usuarios u2 ON f.id_usuario_respuesta = u2.id_usuario 
                  ORDER BY f.fecha_creacion DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}