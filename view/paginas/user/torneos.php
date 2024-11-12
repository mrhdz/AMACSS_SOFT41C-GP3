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
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .tournament-card {
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .tournament-card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        #joinMessage {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 123, 255, 0.9);
            color: white;
            padding: 20px;
            border-radius: 10px;
            display: none;
            z-index: 1000;
            animation: fadeInOut 3s ease-in-out;
        }
        @keyframes fadeInOut {
            0%, 100% { opacity: 0; }
            10%, 90% { opacity: 1; }
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
    <?php include 'menuUs.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Torneos Disponibles</h1>
        
       
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if ($torneos !== false && !empty($torneos)): ?>
                <?php foreach ($torneos as $torneo): ?>
                    <div class="col">
                        <div class="card h-100 tournament-card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($torneo['nombre'] ?? 'Torneo sin nombre'); ?></h5>
                                <p class="card-text">
                                    <strong>Fecha:</strong> <?php echo htmlspecialchars($torneo['fecha'] ?? 'Fecha no disponible'); ?><br>
                                    <strong>Cancha:</strong> <?php echo htmlspecialchars($torneo['nombre_cancha'] ?? 'Cancha no especificada'); ?><br>
                                    <strong>Organizador:</strong> <?php echo htmlspecialchars($torneo['nombre_usuario'] ?? 'Organizador desconocido'); ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <button onclick="unirseAlTorneo(<?php echo htmlspecialchars($torneo['id']); ?>, '<?php echo htmlspecialchars(addslashes($torneo['nombre'])); ?>')" class="btn btn-primary w-100">Unirse al Torneo</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
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