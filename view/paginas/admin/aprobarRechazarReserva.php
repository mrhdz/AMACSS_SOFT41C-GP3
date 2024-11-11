<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    echo json_encode(['error' => 'No tienes permisos para realizar esta acción']);
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/reservaController.php');

$reservaController = new ReservaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idReserva = $_POST['id_reserva'];
    $accion = $_POST['accion'];

    if ($accion === 'aprobar') {
        if ($reservaController->aprobarReserva($idReserva)) {
            echo json_encode(['success' => 'Reserva aprobada con éxito.']);
        } else {
            echo json_encode(['error' => 'Error al aprobar la reserva.']);
        }
    } elseif ($accion === 'rechazar') {
        if ($reservaController->rechazarReserva($idReserva)) {
            echo json_encode(['success' => 'Reserva rechazada con éxito.']);
        } else {
            echo json_encode(['error' => 'Error al rechazar la reserva.']);
        }
    } else {
        echo json_encode(['error' => 'Acción no válida']);
    }
}
?>

