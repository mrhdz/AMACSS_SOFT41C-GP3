<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/reservaController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/reserva.php');

// Obtener los datos del formulario
$idCancha = $_POST['id_cancha'];
$idUsuario = $_POST['id_usuario'];
$fecha = $_POST['fecha'];
$horaInicio = $_POST['hora_inicio'];
$duracion = $_POST['duracion'];

// Calcular la hora de fin
$horaInicioDateTime = new DateTime("$fecha $horaInicio");
$horaInicioDateTime->modify("+$duracion hours");
$horaFin = $horaInicioDateTime->format('H:i'); // Formato de la hora de fin

// Crear nueva reserva con estado 'pendiente'
$reserva = new Reserva();
$reserva->setIdCancha($idCancha);
$reserva->setIdUsuario($idUsuario);
$reserva->setFechaReserva($fecha);
$reserva->setHoraInicio($horaInicio);
$reserva->setHoraFin($horaFin);
$reserva->setDuracion($duracion);
$reserva->setEstado('pendiente'); // Estado inicial: pendiente

// Crear reserva
$reservaController = new ReservaController();
if ($reservaController->crearReserva($reserva)) {
    // Si la reserva se ha creado correctamente, redirigir con un mensaje de éxito
    header("Location: listaCanchas.php?success=true");
} else {
    // Si ha fallado, redirigir con un mensaje de error
    header("Location: listaCanchas.php?success=false");
}

exit();

?>
