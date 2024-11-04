<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>
    <main class="container my-5">
    <!-- Encabezado de la página -->
    <header class="bg-dark text-white text-center py-5">
        <h1>Acerca de Nosotros</h1>
        <p>Tu mejor opción para encontrar el local deportivo ideal</p>
    </header>

    <!-- Sección de contenido principal -->
    <section class="container my-5">
        <div class="row">
            <!-- Imagen representativa -->
            <div class="col-md-6">
                <img src="https://img.freepik.com/vector-gratis/fondo-campo-futbol-estilo-degradado_23-2148995842.jpg" alt="Locales deportivos" class="img-fluid rounded">
            </div>
            <!-- Texto acerca de nosotros -->
            <div class="col-md-6">
                <h2>Nuestra misión</h2>
                <p>En <strong>Alquiler de Locales Deportivos</strong>, nos especializamos en conectar a propietarios de locales con aficionados al deporte y organizadores de eventos. Ofrecemos una plataforma segura y eficiente para que encuentres el espacio perfecto para tus actividades deportivas.</p>

                <h2>Nuestro compromiso</h2>
                <p>Estamos comprometidos en brindar locales deportivos de calidad, adecuados para una amplia gama de deportes y actividades físicas. Ya sea que necesites un espacio para entrenamientos, torneos o eventos deportivos, te ayudamos a encontrar lo que necesitas.</p>

                <h2>¿Por qué elegirnos?</h2>
                <ul>
                    <li>Gran variedad de locales en distintas ubicaciones.</li>
                    <li>Fácil proceso de reserva en línea.</li>
                    <li>Locales verificados para garantizar calidad y seguridad.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Sección de equipo -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2>Conoce a nuestro equipo</h2>
            <p>Nuestro equipo está formado por expertos apasionados por el deporte y comprometidos con ofrecerte el mejor servicio.</p>
            <div class="row">
                <div class="col-md-4">
                    <img src="../img/img1.png" alt="Miembro del equipo" class="rounded-circle mb-3" style="width:150px;height:150px;">
                    <h5>Luis Fernando</h5>
                    <p>Director de Operaciones</p>
                </div>
                <div class="col-md-4">
                    <img src="../img/img2.png" alt="Miembro del equipo" class="rounded-circle mb-3" style="width:150px;height:150px;">
                    <h5>Henry Arevalo</h5>
                    <p>Gerente de Alquileres</p>
                </div>
                <div class="col-md-4">
                    <img src="../img/img3.png" alt="Miembro del equipo" class="rounded-circle mb-3" style="width:150px;height:150px;">
                    <h5>Paola Lopez</h5>
                    <p>Coordinadora de Atención al Cliente</p>
                </div>
                <div class="col-md-4">
                    <img src="../img/img4.png" alt="Miembro del equipo" class="rounded-circle mb-3" style="width:150px;height:150px;">
                    <h5>David Gonzalez</h5>
                    <p>Especialista en Marketing Digital</p>
                </div>
                <div class="col-md-4">
                    <img src="../img/img5.png" alt="Miembro del equipo" class="rounded-circle mb-3" style="width:150px;height:150px;">
                    <h5>David Gonzalez</h5>
                    <p>Gerente de Relaciones Públicas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Alquiler de Locales Deportivos. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
