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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: var(--text-color);
            border-bottom: none;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border-bottom: none;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
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

    <main>
        <div class="container mt-4">
            <h2 class="mb-4">Panel de Control - Eventos por Cancha</h2>
            <?php if (empty($canchas)): ?>
                <p class="text-muted">No tienes canchas registradas.</p>
            <?php else: ?>
                <?php foreach ($canchas as $cancha): ?>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3><?php echo htmlspecialchars($cancha['nombre']); ?></h3>
                        </div>
                        <div class="card-body">
                            <h4>Eventos Programados</h4>
                            <?php
                            $eventos = $torneoController->obtenerTorneosPorCancha($cancha['id_cancha']);
                            if (!empty($eventos)):
                            ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Evento</th>
                                            <th>Fecha</th>
                                            <th>Hora de Inicio</th>
                                            <th>Hora de Fin</th>
                                            <th>Organizador</th>
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
                            <?php else: ?>
                                <p class="text-muted">No hay eventos programados para esta cancha.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>