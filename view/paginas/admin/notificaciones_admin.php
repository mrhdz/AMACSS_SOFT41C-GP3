<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones del Administrador - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
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
        h2 {
            color: #2E7D32;
            margin-bottom: 20px;
        }
        .navbar {
            background-color: #4CAF50;
        }
        .navbar-brand, .nav-link {
            color: white !important;
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
        .footer {
            background-color: #2E7D32;
            color: #ffffff;
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuadmin.php"); ?>
    </header>

    <div class="container mt-4">
        <h2>Notificaciones del Administrador</h2>
        
        <div class="card notification-card unread">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Nueva Reserva</span>
                <a href="#" class="btn btn-sm btn-primary">Marcar como leída</a>
            </div>
            <div class="card-body">
                <p class="card-text">Se ha realizado una nueva reserva para la cancha de fútbol.</p>
                <p class="card-text"><small class="text-muted">Fecha: 2023-07-10 14:30:00</small></p>
                <p class="card-text"><small class="text-muted">Usuario ID: 1234</small></p>
            </div>
        </div>

        <div class="card notification-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Cancelación de Reserva</span>
            </div>
            <div class="card-body">
                <p class="card-text">Un usuario ha cancelado su reserva para la cancha de tenis.</p>
                <p class="card-text"><small class="text-muted">Fecha: 2023-07-09 10:15:00</small></p>
                <p class="card-text"><small class="text-muted">Usuario ID: 5678</small></p>
            </div>
        </div>

        <div class="card notification-card unread">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Nuevo Torneo Creado</span>
                <a href="#" class="btn btn-sm btn-primary">Marcar como leída</a>
            </div>
            <div class="card-body">
                <p class="card-text">Se ha creado un nuevo torneo de baloncesto. Requiere aprobación.</p>
                <p class="card-text"><small class="text-muted">Fecha: 2023-07-08 16:45:00</small></p>
                <p class="card-text"><small class="text-muted">Usuario ID: 9012</small></p>
            </div>
        </div>
    </div>

    <footer class="footer text-center py-3">
        <div class="container">
            <p>&copy; 2024 Sport Space - Alquiler de Locales Deportivos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>