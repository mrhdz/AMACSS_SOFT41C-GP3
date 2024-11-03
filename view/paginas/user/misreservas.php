<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}

$usuarioNombre = $_SESSION['usuario']; // Obtiene el nombre del usuario de la sesión
$usuarioId = $_SESSION['id_usuario']; // Obtiene el id
include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/reservaController.php');

$reservaController = new ReservaController();
$reservas = $reservaController->listarReservasPorUsuario($usuarioId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar'])) {
        $idReserva = $_POST['id_reserva'];
        $reservaController->eliminarReserva($idReserva);
        header("Location: misReservas.php");
        exit();
    } elseif (isset($_POST['id_reserva'])) {
        $idReserva = $_POST['id_reserva'];
        $fecha = $_POST['fecha'];
        $duracion = $_POST['duracion'];
        $estado = $_POST['estado'];

        $reservaController->actualizarReserva($idReserva, $fecha, $duracion, $estado);
        header("Location: misReservas.php"); // Redirigir a la lista de reservas
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis reservas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>
    <br><center><h2><?php echo htmlspecialchars($usuarioNombre); ?>, Aquí puedes ver tus reservas.</h2></center>
    <main class="container my-5">
        <h2 class="text-center">Mis Reservas</h2>

        <?php if ($reservas): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cancha</th>
                        <th>Fecha de Reserva</th>
                        <th>Duración (horas)</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['cancha_nombre']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_reserva']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['duracion']); ?> horas</td>
                            <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                            <td>
                                <!-- Botón de Editar que abre el modal -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal<?php echo $reserva['id_reserva']; ?>">
                                    Editar
                                </button>

                                <!-- Modal para editar reserva -->
                                <div class="modal fade" id="editarModal<?php echo $reserva['id_reserva']; ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editarModalLabel">Editar Reserva</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha de Reserva</label>
                                                        <input type="datetime-local" class="form-control" name="fecha" value="<?php echo date('Y-m-d\TH:i', strtotime($reserva['fecha_reserva'])); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="duracion">Duración (horas)</label>
                                                        <input type="number" class="form-control" name="duracion" value="<?php echo htmlspecialchars($reserva['duracion']); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estado">Estado</label>
                                                        <select class="form-control" name="estado" required>
                                                            <option value="confirmada" <?php echo $reserva['estado'] == 'confirmada' ? 'selected' : ''; ?>>Confirmada</option>
                                                            <option value="cancelada" <?php echo $reserva['estado'] == 'cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                                                            <option value="modificada" <?php echo $reserva['estado'] == 'modificada' ? 'selected' : ''; ?>>Modificada</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-success">Actualizar Reserva</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Botón de Eliminar -->
                                <form action="misReservas.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                                    <button type="submit" name="eliminar" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No tienes reservas en este momento.</p>
        <?php endif; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
