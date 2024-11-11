<?php
// Incluir el archivo del controlador
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/ReservaController.php');

// Crear una instancia del controlador
$reservaController = new ReservaController();

// Obtener las solicitudes pendientes
$solicitudes = $reservaController->listarSolicitudesPendientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reservas - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --accent-color: #FFF176;
            --background-color: #2E7D32;
            --text-color: #ffffff;
            --dark-text: #212121;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e8f5e9;
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--background-color);
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1577223625816-7546f13df25d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: var(--text-color);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .table {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
        }

        main {
            flex: 1;
        }

        #statusMessage {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuadmin.php"); ?>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Gestión de Reservas</h1>
            <p class="lead">Administra las solicitudes pendientes de manera eficiente</p>
        </div>
    </section>

    <main class="container my-5">
        <div id="statusMessage" class="alert" role="alert"></div>

        <?php if (!empty($solicitudes)) { ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Reserva</th>
                            <th>Cancha</th>
                            <th>Usuario</th>
                            <th>Fecha de Reserva</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes as $solicitud) { ?>
                            <tr id="reserva-<?php echo $solicitud['id_reserva']; ?>">
                                <td><?php echo $solicitud['id_reserva']; ?></td>
                                <td><?php echo $solicitud['cancha_nombre']; ?></td>
                                <td><?php echo $solicitud['usuario_nombre']; ?></td>
                                <td><?php echo $solicitud['fecha_reserva']; ?></td>
                                <td><span class="badge bg-warning text-dark"><?php echo $solicitud['estado']; ?></span></td>
                                <td>
                                    <button class="btn btn-success btn-sm action-btn" data-id="<?php echo $solicitud['id_reserva']; ?>" data-accion="aprobar">
                                        <i class="bi bi-check-circle me-1"></i>Aprobar
                                    </button>
                                    <button class="btn btn-danger btn-sm action-btn" data-id="<?php echo $solicitud['id_reserva']; ?>" data-accion="rechazar">
                                        <i class="bi bi-x-circle me-1"></i>Rechazar
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle me-2"></i>No hay solicitudes pendientes en este momento.
            </div>
        <?php } ?>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
$(document).ready(function() {
    $('.action-btn').click(function() {
        var idReserva = $(this).data('id');
        var accion = $(this).data('accion');
        var row = $(this).closest('tr');
        
        $.ajax({
            url: 'aprobarRechazarReserva.php',
            type: 'POST',
            data: {
                id_reserva: idReserva,
                accion: accion
            },
            success: function(response) {
                var data = JSON.parse(response);
                var messageDiv = $('#statusMessage');
                
                if (accion === 'aprobar' && data.success) {
                    messageDiv.removeClass('alert-danger').addClass('alert-success').text(data.success);
                    row.find('.badge').removeClass('bg-warning text-dark').addClass('bg-success').text('Aprobada');
                } else if (accion === 'rechazar' && data.success) {
                    messageDiv.removeClass('alert-success').addClass('alert-danger').text(data.success);
                    row.find('.badge').removeClass('bg-warning text-dark').addClass('bg-danger').text('Rechazada');
                } else if (data.error) {
                    messageDiv.removeClass('alert-success').addClass('alert-danger').text(data.error);
                }
                
                messageDiv.fadeIn().delay(2000).fadeOut();
                row.fadeOut(400, function() {
                    $(this).remove();
                    if ($('tbody tr').length === 0) {
                        $('.table-responsive').replaceWith('<div class="alert alert-info" role="alert"><i class="bi bi-info-circle me-2"></i>No hay solicitudes pendientes en este momento.</div>');
                    }
                });
            },
            error: function() {
                $('#statusMessage').removeClass('alert-success').addClass('alert-danger').text('Hubo un error al procesar la solicitud.');
                $('#statusMessage').fadeIn().delay(2000).fadeOut();
            }
        });
    });
});
</script>
</body>
</html>