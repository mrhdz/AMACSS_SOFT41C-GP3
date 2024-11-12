<?php
session_start();
// Verificar si el usuario ha iniciado sesión y es un administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/canchaController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/TorneoController.php');

$canchaController = new CanchaController();
$torneoController = new TorneoController();

// Obtener el ID del usuario administrador actual
$usuarioId = $_SESSION['id_usuario'];

// Obtener solo las canchas del administrador actual
$canchas = $canchaController->listar($usuarioId);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --accent-color: #FF9800;
            --background-color: #1c2331;
            --text-color: #ffffff;
            --dark-text: #333333;
            --card-bg: #ffffff;
            --hover-color: #2E7D32;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--background-color);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .navbar-brand img {
            max-height: 40px;
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1476&q=80');
            background-size: cover;
            background-position: center;
            height: 50vh;
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
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            background-color: var(--card-bg);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: var(--primary-color);
            color: var(--text-color);
            border-bottom: none;
            padding: 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 30px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border-bottom: none;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 15px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
            margin-top: auto;
        }

        main {
            flex: 1;
            padding: 40px 0;
        }

        .btn-custom {
            background-color: var(--accent-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
        }

        .alert-custom {
            background-color: var(--accent-color);
            color: var(--text-color);
            border: none;
            border-radius: 10px;
        }

        .icon-large {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuadmin.php"); ?>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Panel de Control</h1>
            <p class="hero-subtitle">Gestiona tus canchas y eventos de manera eficiente</p>
            <a href="#main-content" class="btn btn-custom btn-lg">Explorar Eventos</a>
        </div>
    </section>

    <main id="main-content" class="container my-5">
        <h2 class="section-title"><i class="bi bi-calendar-event me-2"></i>Eventos por Cancha</h2>
        <?php if (empty($canchas)): ?>
            <div class="alert alert-custom" role="alert">
                <i class="bi bi-info-circle icon-large d-block"></i>
                <h4 class="alert-heading">No tienes canchas registradas</h4>
                <p>Comienza agregando tu primera cancha para gestionar eventos.</p>
                <hr>
                <p class="mb-0">
                    <a href="#" class="btn btn-outline-light">Agregar Nueva Cancha</a>
                </p>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($canchas as $cancha): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h3 class="mb-0"><i class="bi bi-geo-alt me-2"></i><?php echo htmlspecialchars($cancha['nombre']); ?></h3>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-3"><i class="bi bi-calendar-check me-2"></i>Eventos Programados</h4>
                                <?php
                                $eventos = $torneoController->obtenerTorneosPorCancha($cancha['id_cancha']);
                                if (!empty($eventos)):
                                ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th><i class="bi bi-trophy me-2"></i>Nombre del Evento</th>
                                                    <th><i class="bi bi-calendar me-2"></i>Fecha</th>
                                                    <th><i class="bi bi-clock me-2"></i>Hora de Inicio</th>
                                                    <th><i class="bi bi-clock-history me-2"></i>Hora de Fin</th>
                                                    <th><i class="bi bi-person me-2"></i>Organizador</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($eventos as $evento): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($evento['nombre']); ?></td>
                                                        <td><?php echo htmlspecialchars($evento['fecha']); ?></td>
                                                        <td><?php echo htmlspecialchars($evento['hora_inicio']); ?></td>
                                                        <td><?php echo htmlspecialchars($evento['hora_fin']); ?></td>
                                                        <td><?php echo htmlspecialchars($evento['nombre_organizador']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="bi bi-calendar-x icon-large text-muted"></i>
                                        <p class="text-muted mt-2">No hay eventos programados para esta cancha.</p>
                                        <a href="#" class="btn btn-custom mt-3">Agregar Evento</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll for the "Explorar Eventos" button
        document.querySelector('a[href="#main-content"]').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>