<?php
session_start();
require_once("../../controller/notificacionController.php");

$notificacionController = new NotificacionController();
$notificaciones = $notificacionController->obtenerNotificacionesUsuario($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Notificaciones</h2>
        <?php if (count($notificaciones) > 0): ?>
            <ul class="list-group">
                <?php foreach ($notificaciones as $notificacion): ?>
                    <li class="list-group-item">
                        <i class="fas fa-bell me-2"></i>
                        <?php echo $notificacion['mensaje']; ?>
                        <small class="text-muted"><?php echo $notificacion['fecha']; ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No tienes notificaciones nuevas.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>