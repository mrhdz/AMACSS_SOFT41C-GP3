<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/notificacionController.php');

// Verificar si el usuario ha iniciado sesión y es un administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

$notificacionController = new NotificacionController();

// Marcar notificación como leída si se proporciona un ID
if (isset($_GET['marcar_leida']) && is_numeric($_GET['marcar_leida'])) {
    $notificacionController->marcarComoLeida($_GET['marcar_leida']);
}

$notificaciones = $notificacionController->obtenerNotificacionesAdmin($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones del Administrador - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .notification-card {
            margin-bottom: 20px;
            border-left: 4px solid #4CAF50;
        }
        .notification-card .card-header {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .notification-card .card-body {
            background-color: #ffffff;
        }
        .unread {
            background-color: #e8f5e9;
        }
    </style>
</head>
<body>
    <?php include 'menuadmin.php'; ?>

    <div class="container mt-4">
        <h2 class="mb-4">Notificaciones del Administrador</h2>
        
        <?php if (empty($notificaciones)): ?>
            <div class="alert alert-info">No hay notificaciones disponibles.</div>
        <?php else: ?>
            <?php foreach ($notificaciones as $notificacion): ?>
                <div class="card notification-card <?php echo $notificacion['leida'] ? '' : 'unread'; ?>">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Notificación</span>
                        <?php if (!$notificacion['leida']): ?>
                            <a href="?marcar_leida=<?php echo $notificacion['id']; ?>" class="btn btn-sm btn-primary">Marcar como leída</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($notificacion['mensaje']); ?></p>
                        <p class="card-text"><small class="text-muted">Fecha: <?php echo htmlspecialchars($notificacion['fecha']); ?></small></p>
                        <p class="card-text"><small class="text-muted">Usuario ID: <?php echo htmlspecialchars($notificacion['id_usuario']); ?></small></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>