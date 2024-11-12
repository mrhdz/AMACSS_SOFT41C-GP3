<?php
// obtener_participantes.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/TorneoController.php');

if (isset($_GET['id_torneo'])) {
    $torneoController = new TorneoController();
    $id_torneo = intval($_GET['id_torneo']);
    $participantes = $torneoController->obtenerParticipantesTorneo($id_torneo);

    if ($participantes !== false) {
        echo json_encode(['success' => true, 'participantes' => $participantes]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener los participantes']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de torneo no proporcionado']);
}