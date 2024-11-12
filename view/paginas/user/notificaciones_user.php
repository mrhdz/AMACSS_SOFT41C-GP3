<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        h1 {
            color: #2E7D32;
            text-align: center;
        }
        .notification-item {
            border-left: 4px solid #4CAF50;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }
        .notification-item:hover {
            background-color: #e9ecef;
        }
        .notification-icon {
            color: #4CAF50;
        }
        .notification-time {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .footer {
            background-color: #2E7D32;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>

    <div class="container">
        <h1>Notificaciones</h1>
        <div class="card">
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item notification-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <i class="fas fa-calendar-check notification-icon me-2"></i>
                                Reserva confirmada
                            </h5>
                            <small class="notification-time">Hace 2 horas</small>
                        </div>
                        <p class="mb-1">Tu reserva para la cancha de fútbol el 15 de julio a las 18:00 ha sido confirmada.</p>
                    </div>
                    <div class="list-group-item notification-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <i class="fas fa-trophy notification-icon me-2"></i>
                                Nuevo torneo disponible
                            </h5>
                            <small class="notification-time">Ayer</small>
                        </div>
                        <p class="mb-1">Se ha abierto la inscripción para el torneo de verano. ¡No te lo pierdas!</p>
                    </div>
                    <div class="list-group-item notification-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <i class="fas fa-coins notification-icon me-2"></i>
                                Descuento especial
                            </h5>
                            <small class="notification-time">Hace 2 días</small>
                        </div>
                        <p class="mb-1">Obtén un 20% de descuento en tu próxima reserva utilizando el código VERANO20.</p>
                    </div>
                    <div class="list-group-item notification-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <i class="fas fa-exclamation-circle notification-icon me-2"></i>
                                Mantenimiento programado
                            </h5>
                            <small class="notification-time">Hace 1 semana</small>
                        </div>
                        <p class="mb-1">La cancha de tenis estará cerrada por mantenimiento del 20 al 22 de julio.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center py-3">
        <div class="container">
            <p>&copy; 2024 Alquiler de Locales Deportivos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>