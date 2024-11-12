<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}
$usuarioId = $_SESSION['id_usuario']; // Obtiene el ID del usuario desde la sesión
$usuarioNombre = $_SESSION['usuario']; // Obtiene el nombre del usuario de la sesión

require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/canchaController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/reserva.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/reservaController.php');


$canchaController = new CanchaController();
$canchasDisponibles = $canchaController->listarDisponibles();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCancha = $_POST['id_cancha'];
    $idUsuario = $_POST['id_usuario'];
    $fecha = $_POST['fecha'];
    $horaInicio = $_POST['hora_inicio'];
    $duracion = $_POST['duracion'];
    $estado = $_POST['estado'];
    
    $reserva = new Reserva();
    $reserva->setIdCancha($idCancha);
    $reserva->setIdUsuario($idUsuario);
    $reserva->setFechaReserva($fecha);
    $reserva->setHoraFin($horaInicio);
    $reserva->setDuracion($duracion);
    $reserva->setEstado($estado);

    $reservaController = new ReservaController();
    if ($reservaController->crearReserva($reserva)) {
        header("Location:?success=true");
    } else {
        header("Location: ?success=false");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canchas Disponibles - Sport Space</title>
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
            background-image: url('https://images.unsplash.com/photo-1459865264687-595d652de67e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
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

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .card-text {
            font-size: 0.9rem;
            color: var(--dark-text);
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 20px;
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
            margin-top: auto;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold"><?php echo htmlspecialchars($usuarioNombre); ?>, Explora Nuestras Canchas</h1>
            <p class="lead">Encuentra y reserva la cancha perfecta para tu próximo partido</p>
        </div>
    </section>

    <main class="container my-5">
        <?php
        if (isset($_GET['success'])) {
            if ($_GET['success'] == 'true') {
                echo "<div class='alert alert-success'>¡La solicitud de alquiler se ha enviado correctamente!</div>";
            } else {
                echo "<div class='alert alert-danger'>Hubo un error al enviar la solicitud de alquiler. Por favor, inténtalo de nuevo.</div>";
            }
        }
        ?>

        <h2 class="text-center mb-4">Canchas Disponibles</h2>
        <div class="row">
            <?php foreach ($canchasDisponibles as $cancha): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($cancha["urlImagen"]); ?>" class="card-img-top" alt="Imagen de la cancha">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($cancha["nombre"]); ?></h5>
                            <p class="card-text">Propietario: <?php echo htmlspecialchars($cancha["propietario_nombre"]); ?></p>
                            <p class="card-text">Tipo: <?php echo htmlspecialchars($cancha["tipo"]); ?></p>
                            <p class="card-text">Capacidad: <?php echo htmlspecialchars($cancha["capacidad"]); ?> personas</p>
                            <p class="card-text"><?php echo htmlspecialchars($cancha["descripcion"]); ?></p>
                            <p class="price mt-auto">$<?php echo htmlspecialchars($cancha["precio"]); ?> por hora</p>
                            
                            <form action="solicitarAlquiler.php" method="POST" class="mt-3">
                                <input type="hidden" name="id_cancha" value="<?php echo htmlspecialchars($cancha["id_cancha"]); ?>">
                                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($usuarioId); ?>">
                                
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha de reserva:</label>
                                    <input type="date" name="fecha" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="hora_inicio" class="form-label">Hora de inicio:</label>
                                    <input type="time" name="hora_inicio" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="duracion" class="form-label">Duración (horas):</label>
                                    <input type="number" name="duracion" min="1" max="5" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-custom w-100">
                                    <i class="bi bi-calendar-check me-2"></i>Reservar Ahora
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>