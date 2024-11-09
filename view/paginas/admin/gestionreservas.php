<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}
$usuarioId = $_SESSION['id_usuario']; // Obtiene el ID del usuario desde la sesión
$usuarioNombre = $_SESSION['usuario']; // Obtiene el nombre del usuario de la sesión
// Asegúrate de que el ID de usuario esté almacenado en la sesión



include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/reservaController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/cancha.php');
$reservaController = new ReservaController();
$solicitudes = $reservaController->listarSolicitudesPendientes(); // Listar las solicitudes pendientes

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reservas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h2>Solicitudes de Alquiler de Canchas</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cancha</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?php echo htmlspecialchars($solicitud['cancha_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['usuario_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['fecha_reserva']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['hora_inicio']); ?></td>
                    <td><?php echo htmlspecialchars($solicitud['hora_fin']); ?></td>
                    <td>
                        <form action="aprobarRechazarReserva.php" method="post">
                            <input type="hidden" name="id_reserva" value="<?php echo $solicitud['id_reserva']; ?>">
                            <button type="submit" name="accion" value="aprobar" class="btn btn-success btn-sm">Aprobar</button>
                            <button type="submit" name="accion" value="rechazar" class="btn btn-danger btn-sm">Rechazar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
