<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/torneoController.php');

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php");
    exit();
}

$torneoController = new TorneoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_torneo'])) {
    $id_torneo = intval($_POST['id_torneo']);
    $id_usuario = $_SESSION['id_usuario'];
    $nombre_torneo = $_POST['nombre_torneo'] ?? 'Torneo desconocido';
    
    $resultado = $torneoController->unirseATorneo($id_torneo, $id_usuario);
    
    if ($resultado['success']) {
        $mensaje = "Te has unido exitosamente al torneo: " . htmlspecialchars($nombre_torneo);
    } else {
        $mensaje = "Error: " . $resultado['message'];
    }
    
    // Redirigir de vuelta a la página de torneos con un mensaje
    header("Location: torneos.php?mensaje=" . urlencode($mensaje));
    exit();
} else {
    header("Location: torneos.php");
    exit();
}