<?php
// Activar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión y verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

// Incluir el controlador de torneos
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/TorneoController.php');

// Crear una instancia del controlador y obtener los torneos
$torneoController = new TorneoController();
$torneos = $torneoController->obtenerTodosLosTorneos();

// Manejar la solicitud AJAX para unirse a un torneo
if (isset($_GET['id'])) {
    header('Content-Type: application/json');
    $id_torneo = intval($_GET['id']);
    $id_usuario = $_SESSION['id_usuario'];
    $resultado = $torneoController->unirseATorneo($id_torneo, $id_usuario);
    echo json_encode($resultado);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
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

        .container {
            flex: 1 0 auto;
        }

        .tournament-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tournament-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            color: var(--primary-color);
            font-weight: bold;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: scale(1.05);
        }

        #joinMessage {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: var(--primary-color);
            color: var(--text-color);
            padding: 20px;
            border-radius: 15px;
            display: none;
            z-index: 1000;
            animation: fadeInOut 3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeInOut {
            0%, 100% { opacity: 0; }
            10%, 90% { opacity: 1; }
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
            margin-top: auto;
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1459865264687-595d652de67e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: var(--text-color);
            margin-bottom: 2rem;
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
    </style>
</head>
<body>
    <?php include 'menuUs.php'; ?>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Explora Nuestros Torneos</h1>
            <p class="lead">Únete a emocionantes competiciones y demuestra tus habilidades</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-4">Torneos Disponibles</h2>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if ($torneos !== false && !empty($torneos)): ?>
                <?php foreach ($torneos as $torneo): ?>
                    <div class="col">
                        <div class="card h-100 tournament-card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($torneo['nombre'] ?? 'Torneo sin nombre'); ?></h5>
                                <p class="card-text">
                                    <strong><i class="bi bi-calendar-event"></i> Fecha:</strong> <?php echo htmlspecialchars($torneo['fecha'] ?? 'Fecha no disponible'); ?><br>
                                    <strong><i class="bi bi-geo-alt"></i> Cancha:</strong> <?php echo htmlspecialchars($torneo['nombre_cancha'] ?? 'Cancha no especificada'); ?><br>
                                    <strong><i class="bi bi-person"></i> Organizador:</strong> <?php echo htmlspecialchars($torneo['nombre_usuario'] ?? 'Organizador desconocido'); ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <button onclick="unirseAlTorneo(<?php echo htmlspecialchars($torneo['id']); ?>, '<?php echo htmlspecialchars(addslashes($torneo['nombre'])); ?>')" class="btn btn-primary w-100">
                                    <i class="bi bi-person-plus-fill me-2"></i>Unirse al Torneo
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <?php if ($torneos === false): ?>
                            Ha ocurrido un error al obtener los torneos. Por favor, inténtelo de nuevo más tarde.
                        <?php else: ?>
                            No hay torneos disponibles en este momento.
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="joinMessage"></div>

    <footer class="footer text-center py-3">
        <div class="container">
            <p>&copy; 2024 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function unirseAlTorneo(idTorneo, nombreTorneo) {
        fetch('torneos.php?id=' + idTorneo, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarMensaje("Te has unido al torneo: " + nombreTorneo);
            } else {
                mostrarMensaje("Error: " + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            mostrarMensaje("Error al unirse al torneo");
        });
    }

    function mostrarMensaje(mensaje) {
        const messageElement = document.getElementById('joinMessage');
        messageElement.textContent = mensaje;
        messageElement.style.display = 'block';
        setTimeout(() => {
            messageElement.style.display = 'none';
        }, 3000);
    }
    </script>
</body>
</html>