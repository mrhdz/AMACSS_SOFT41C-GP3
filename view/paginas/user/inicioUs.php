<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}

$usuarioNombre = htmlspecialchars($_SESSION['usuario']); // Obtiene el nombre del usuario de la sesión
$usuarioId = $_SESSION['id_usuario']; // Obtiene el id
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Sport Space - Reserva tu Cancha de Fútbol</title>
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
        }

        .navbar {
            background-color: var(--background-color);
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1459865264687-595d652de67e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
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
            color: var(--text-color);
        }

        .feature-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .btn-custom {
            background-color: var(--accent-color);
            color: var(--dark-text);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--primary-color);
            color: var(--text-color);
            transform: scale(1.05);
        }

        .quick-actions {
            background-color: var(--background-color);
            border-radius: 15px;
            padding: 2rem;
            color: var(--text-color);
        }

        .action-btn {
            background-color: var(--accent-color);
            color: var(--dark-text);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background-color: var(--primary-color);
            color: var(--text-color);
            transform: scale(1.05);
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>

    <main>
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">¡Bienvenido, <?php echo $usuarioNombre; ?>!</h1>
                <p class="lead mb-4">Reserva tu cancha de fútbol favorita en minutos</p>
                <a href="#features" class="btn btn-custom btn-lg">Explora Nuestras Canchas</a>
            </div>
        </section>

        <div class="container mt-5">
            <section id="features" class="row">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-calendar-check feature-icon"></i>
                        <h3>Reserva Fácil</h3>
                        <p>Reserva tu cancha de fútbol en segundos con nuestra interfaz intuitiva.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-geo-alt feature-icon"></i>
                        <h3>Múltiples Ubicaciones</h3>
                        <p>Encuentra canchas de fútbol cerca de ti con nuestro mapa interactivo.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-people feature-icon"></i>
                        <h3>Organiza Partidos</h3>
                        <p>Crea eventos de fútbol y invita a tus amigos fácilmente.</p>
                    </div>
                </div>
            </section>

            <section class="quick-actions mt-5 text-center">
                <h2 class="mb-4">Acciones Rápidas</h2>
                <a href="listacanchas.php" class="btn action-btn"><i class="bi bi-search me-2"></i>Buscar Canchas</a>
                <a href="misreservas.php" class="btn action-btn"><i class="bi bi-bookmark me-2"></i>Mis Reservas</a>
                <a href="#" class="btn action-btn"><i class="bi bi-person me-2"></i>Mi Perfil</a>
            </section>
        </div>
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animación suave al hacer scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>