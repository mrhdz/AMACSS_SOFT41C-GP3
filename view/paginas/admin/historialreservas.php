<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/reservaController.php');

$reservaController = new ReservaController();
$historial = $reservaController->obtenerHistorialReservas();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Reservas - Sport Space</title>
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
            background-image: url('https://images.unsplash.com/photo-1551958219-acbc608c6377?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
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

        main {
            flex: 1;
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuadmin.php"); ?>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Historial de Reservas</h1>
            <p class="lead">Revisa los cambios y actualizaciones de las reservas</p>
        </div>
    </section>

    <main class="container my-5">
        <?php if ($historial): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Reserva</th>
                            <th>Fecha de Modificación</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historial as $registro): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registro['id_reserva']); ?></td>
                                <td><?php echo htmlspecialchars($registro['fecha_modificacion']); ?></td>
                                <td>
                                    <?php
                                    $cambio = htmlspecialchars($registro['cambio']);
                                    $badgeClass = 'bg-secondary';
                                    $icon = 'bi-info-circle';
                                    
                                    if (strpos($cambio, 'Aprobada') !== false) {
                                        $badgeClass = 'bg-success';
                                        $icon = 'bi-check-circle';
                                    } elseif (strpos($cambio, 'Rechazada') !== false) {
                                        $badgeClass = 'bg-danger';
                                        $icon = 'bi-x-circle';
                                    } elseif (strpos($cambio, 'Pendiente') !== false) {
                                        $badgeClass = 'bg-warning text-dark';
                                        $icon = 'bi-clock';
                                    }
                                    ?>
                                    <span class="badge <?php echo $badgeClass; ?>">
                                        <i class="bi <?php echo $icon; ?> me-1"></i><?php echo $cambio; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center" role="alert">
                <i class="bi bi-info-circle me-2"></i>No hay cambios registrados en el historial.
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>