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
    <title>Panel de Administración - Sport Space</title>
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
            background-image: url('../img/background.jpg');
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
        <?php require_once("menuadmin.php"); ?>
    </header>

    <main>
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">¡Bienvenido, <?php echo $usuarioNombre; ?>!</h1>
                <p class="lead mb-4">Panel de Administración de Sport Space</p>
            </div>
        </section>

        <div class="container mt-5">
            <div class="jumbotron bg-white p-5 rounded">
                <h2 class="display-5">Panel de Administración</h2>
                <p class="lead">Gracias por iniciar sesión en el Panel de Administración. Aquí puedes gestionar usuarios, canchas y reservas.</p>
                <hr class="my-4">
                <p>Utiliza el menú superior para acceder a las distintas secciones y administrar los recursos de manera eficiente.</p>
            </div>

            <section class="row mt-5">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-people feature-icon"></i>
                        <h3>Gestión de Usuarios</h3>
                        <p>Administra las cuentas de usuarios y sus permisos.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-geo-alt feature-icon"></i>
                        <h3>Gestión de Canchas</h3>
                        <p>Añade, edita o elimina canchas del sistema.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-calendar-check feature-icon"></i>
                        <h3>Gestión de Reservas</h3>
                        <p>Supervisa y gestiona las reservas de los usuarios.</p>
                    </div>
                </div>
            </section>

            <section class="quick-actions mt-5 text-center">
                <h2 class="mb-4">Acciones Rápidas</h2>
                <a href="gestioncanchas.php" class="btn action-btn"><i class="bi bi-plus-circle me-2"></i>Añadir Cancha</a>
                <a href="gestionreservas.php" class="btn action-btn"><i class="bi bi-calendar2-week me-2"></i>Ver Reservas</a>
                <a href="historialreservas.php" class="btn action-btn"><i class="bi bi-clock-history me-2"></i>Historial</a>
            </section>
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