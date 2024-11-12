<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Canchas - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #f39c12;
            --background-color: #2c3e50;
            --text-color: #ffffff;
            --dark-text: #333333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ecf0f1;
            color: var(--dark-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--background-color);
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1579952363873-27f3bade9f55?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
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
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .map-container {
            background-color: #e8f5e9;
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            height: 600px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .map {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            grid-template-rows: repeat(10, 1fr);
            height: 100%;
        }

        .map-tile {
            border: 1px solid #a5d6a7;
            background-color: #c8e6c9;
            transition: background-color 0.3s;
        }

        .map-tile:hover {
            background-color: #81c784;
        }

        .map-marker {
            width: 30px;
            height: 30px;
            background-color: var(--accent-color);
            border-radius: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .map-marker:hover {
            transform: translate(-50%, -50%) scale(1.1);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .tooltip {
            position: absolute;
            background-color: white;
            border: 1px solid var(--primary-color);
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
        <?php require_once("menuUs.php"); ?>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Mapa de Canchas</h1>
            <p class="lead">Explora las mejores instalaciones deportivas de Sport Space</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="map-container">
            <div class="map">
                <!-- Map tiles -->
                <?php for ($i = 0; $i < 100; $i++): ?>
                    <div class="map-tile"></div>
                <?php endfor; ?>
            </div>
            <!-- Map markers -->
            <div class="map-marker" style="top: 20%; left: 30%;" data-name="Cancha El Pinar"><i class="fas fa-futbol"></i></div>
            <div class="map-marker" style="top: 40%; left: 60%;" data-name="Estadio Cuscatlán"><i class="fas fa-flag"></i></div>
            <div class="map-marker" style="top: 70%; left: 45%;" data-name="Polideportivo UES"><i class="fas fa-running"></i></div>
            <div class="map-marker" style="top: 55%; left: 75%;" data-name="Cancha La Sultana"><i class="fas fa-basketball-ball"></i></div>
            <div class="map-marker" style="top: 85%; left: 20%;" data-name="Complejo Deportivo FESA"><i class="fas fa-volleyball-ball"></i></div>
            <div class="tooltip"></div>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const markers = document.querySelectorAll('.map-marker');
        const tooltip = document.querySelector('.tooltip');

        markers.forEach(marker => {
            marker.addEventListener('mouseenter', (e) => {
                const rect = e.target.getBoundingClientRect();
                const name = e.target.getAttribute('data-name');
                tooltip.textContent = name;
                tooltip.style.left = `${rect.left}px`;
                tooltip.style.top = `${rect.top - 40}px`;
                tooltip.style.opacity = 1;
            });

            marker.addEventListener('mouseleave', () => {
                tooltip.style.opacity = 0;
            });
        });
    </script>
</body>
</html>