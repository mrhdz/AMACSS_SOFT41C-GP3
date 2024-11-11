<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}

$usuarioNombre = $_SESSION['usuario']; // Obtiene el nombre del usuario de la sesión
$usuarioId = $_SESSION['id_usuario']; // Obtiene el id

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Nosotros - Sport Space</title>
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
            background-image: url('https://images.unsplash.com/photo-1529900748604-07564a03e7a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
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
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 1rem;
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

        .team-member img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid var(--primary-color);
            transition: transform 0.3s ease;
        }

        .team-member:hover img {
            transform: scale(1.1);
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>

    <main>
        <!-- Hero section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">Acerca de Nosotros</h1>
                <p class="lead">Tu mejor opción para encontrar el local deportivo ideal</p>
            </div>
        </section>

        <!-- Sección de contenido principal -->
        <section class="container my-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1459865264687-595d652de67e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Locales deportivos" class="img-fluid rounded shadow-lg">
                </div>
                <div class="col-md-6">
                    <h2 class="section-title"><i class="bi bi-bullseye me-2"></i>Nuestra misión</h2>
                    <p>En <strong>Alquiler de Locales Deportivos</strong>, nos especializamos en conectar a propietarios de locales con aficionados al deporte y organizadores de eventos. Ofrecemos una plataforma segura y eficiente para que encuentres el espacio perfecto para tus actividades deportivas.</p>

                    <h2 class="section-title mt-4"><i class="bi bi-hand-thumbs-up me-2"></i>Nuestro compromiso</h2>
                    <p>Estamos comprometidos en brindar locales deportivos de calidad, adecuados para una amplia gama de deportes y actividades físicas. Ya sea que necesites un espacio para entrenamientos, torneos o eventos deportivos, te ayudamos a encontrar lo que necesitas.</p>

                    <h2 class="section-title mt-4"><i class="bi bi-trophy me-2"></i>¿Por qué elegirnos?</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Gran variedad de locales en distintas ubicaciones.</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Fácil proceso de reserva en línea.</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>Locales verificados para garantizar calidad y seguridad.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Sección de equipo -->
        <section class="bg-light py-5">
            <div class="container text-center">
                <h2 class="section-title mb-5"><i class="bi bi-people-fill me-2"></i>Conoce a nuestro equipo</h2>
                <p class="lead mb-5">Nuestro equipo está formado por expertos apasionados por el deporte y comprometidos con ofrecerte el mejor servicio.</p>
                <div class="row">
                    <div class="col-md-4 mb-4 team-member">
                        <img src="../img/img1.png" alt="Luis Fernando" class="rounded-circle mb-3">
                        <h5>Luis Fernando</h5>
                        <p class="text-muted">Director de Operaciones</p>
                    </div>
                    <div class="col-md-4 mb-4 team-member">
                        <img src="../img/img2.png" alt="Henry Arevalo" class="rounded-circle mb-3">
                        <h5>Henry Arevalo</h5>
                        <p class="text-muted">Gerente de Alquileres</p>
                    </div>
                    <div class="col-md-4 mb-4 team-member">
                        <img src="../img/img3.png" alt="Paola Lopez" class="rounded-circle mb-3">
                        <h5>Paola Lopez</h5>
                        <p class="text-muted">Coordinadora de Atención al Cliente</p>
                    </div>
                    <div class="col-md-4 mb-4 team-member">
                        <img src="../img/img4.png" alt="David Gonzalez" class="rounded-circle mb-3">
                        <h5>David Gonzalez</h5>
                        <p class="text-muted">Especialista en Marketing Digital</p>
                    </div>
                    <div class="col-md-4 mb-4 team-member">
                        <img src="../img/img5.png" alt="Ana Martinez" class="rounded-circle mb-3">
                        <h5>Ana Martinez</h5>
                        <p class="text-muted">Gerente de Relaciones Públicas</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="footer text-center py-3">
        <div class="container">
            <p>&copy; 2024 Alquiler de Locales Deportivos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>