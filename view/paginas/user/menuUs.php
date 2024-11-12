<?php
// Check if a session is already active before starting a new one
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/notificacionController.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php");
    exit();
}

$notificacionController = new NotificacionController();
$notificacionesNoLeidas = $notificacionController->contarNotificacionesNoLeidas($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Space - Navegación de Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --background-color: #2E7D32;
            --text-color: #ffffff;
            --hover-color: #1b5e20;
            --accent-color: #FFF176;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e8f5e9;
            padding-top: 80px;
        }

        .navbar {
            background: linear-gradient(135deg, var(--background-color), var(--primary-color));
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-logo img {
            width: 40px;
            height: auto;
            margin-right: 10px;
        }

        .navbar-logo span {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 20px;
            color: var(--text-color);
        }

        .navbar-menu {
            display: flex;
            align-items: center;
        }

        .navbar-menu a {
            color: var(--text-color);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .navbar-menu a:hover {
            background-color: var(--hover-color);
        }

        .navbar-menu a i {
            margin-right: 6px;
            font-size: 1.1em;
        }

        .navbar-user {
            position: relative;
        }

        .user-icon {
            font-size: 20px;
            color: var(--text-color);
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 50%;
        }

        .user-icon:hover {
            background-color: var(--hover-color);
        }

        .user-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--background-color);
            border-radius: 5px;
            padding: 10px 0;
            min-width: 180px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-menu.active {
            display: block;
        }

        .user-menu a {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: var(--text-color);
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .user-menu a:hover {
            background-color: var(--hover-color);
        }

        .user-menu a i {
            margin-right: 8px;
            font-size: 1.1em;
        }

        .btn-logout {
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            background-color: var(--background-color);
            font-size: 14px;
        }

        .btn-logout:hover {
            background-color: #c62828;
        }

        .navbar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 24px;
            cursor: pointer;
        }

        .badge {
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            margin-left: 5px;
        }

        @media (max-width: 1024px) {
            .navbar-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: var(--background-color);
                padding: 20px;
            }

            .navbar-menu.active {
                display: flex;
            }

            .navbar-menu a {
                padding: 10px 15px;
            }

            .navbar-toggle {
                display: block;
            }

            .navbar-container {
                flex-wrap: wrap;
            }

            .navbar-user {
                margin-left: auto;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="inicioUs.php" class="navbar-logo">
                <img src="../img/logo blanco.png" alt="Logo">
                <span>Sport Space</span>
            </a>
            
            <button class="navbar-toggle" id="navbar-toggle">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="navbar-menu" id="navbar-menu">
                <a href="listacanchas.php"><i class="bi bi-calendar2-week"></i> Ver canchas</a>
                <a href="misreservas.php"><i class="bi bi-bookmark-check"></i> Mis reservas</a>
                <a href="mapa_canchas.php"><i class="bi bi-map"></i> Mapa</a>
                <a href="crear_torneo.php"><i class="bi bi-trophy"></i> Crear Evento</a>
                <a href="torneos.php"><i class="bi bi-calendar-event"></i> Torneos</a>
                <a href="notificaciones_user.php">
                    <i class="bi bi-bell"></i> Notificaciones
                    <?php if ($notificacionesNoLeidas > 0): ?>
                        <span class="badge"><?php echo $notificacionesNoLeidas; ?></span>
                    <?php endif; ?>
                </a>
                <a href="faq.php"><i class="bi bi-question-circle"></i> FAQ</a>
                <a href="acercade.php"><i class="bi bi-info-circle"></i> Acerca de</a>
            </div>
            
            <div class="navbar-user">
                <i class="bi bi-person-circle user-icon" id="userMenuToggle"></i>
                <div class="user-menu" id="userMenu">
                    <a href="#"><i class="bi bi-person"></i> Perfil</a>
                    <a href="#"><i class="bi bi-gear"></i> Configuración</a>
                    <a href="../../../inicio.php" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            document.getElementById('navbar-menu').classList.toggle('active');
        });

        document.getElementById('userMenuToggle').addEventListener('click', function(event) {
            event.stopPropagation();
            document.getElementById('userMenu').classList.toggle('active');
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.navbar-user')) {
                document.getElementById('userMenu').classList.remove('active');
            }
        });
    </script>
</body>
</html>