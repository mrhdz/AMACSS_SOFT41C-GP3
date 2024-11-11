<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Space - Reserva tu cancha al instante</title>
    <link rel="icon" href="https://example.com/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Oswald:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --grass-dark: #2E7D32;
            --grass-light: #4CAF50;
            --field-line: #FFFFFF;
            --soccer-ball: #212121;
            --sky-blue: #64B5F6;
            --accent-yellow: #FFF176;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--field-line);
            color: var(--soccer-ball);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1551958219-acbc608c6377?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: var(--field-line);
            padding: 100px 0;
            position: relative;
        }

        .hero-section::before {
            content: "";
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
        }

        .search-bar {
            background: var(--field-line);
            border-radius: 50px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--sky-blue);
            border-color: var(--sky-blue);
        }

        .btn-primary:hover {
            background-color: var(--grass-light);
            border-color: var(--grass-light);
        }

        .section-title {
            color: var(--grass-dark);
            font-weight: bold;
            text-transform: uppercase;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: var(--field-line);
        }

        .card:hover {
            transform: translateY(-5px);
        }
        
        .main-header {
            background: linear-gradient(to right, var(--grass-dark), var(--grass-light));
            padding: 1rem 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .main-header .nav-link {
            color: var(--field-line) !important;
            font-weight: 600;
            text-transform: uppercase;
            position: relative;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }

        .main-header .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-yellow);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .main-header .nav-link:hover::after {
            width: 100%;
        }

        .auth-buttons .btn {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-weight: 600;
        }

        .auth-buttons .btn-outline-light:hover {
            background-color: var(--accent-yellow);
            color: var(--soccer-ball);
        }

        .modern-footer {
            background-color: var(--grass-dark);
            color: var(--field-line);
            padding: 4rem 0 2rem 0;
        }

        .footer-title {
            color: var(--accent-yellow);
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: var(--field-line);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--accent-yellow);
        }

        .social-icons a {
            color: var(--field-line);
            margin-right: 1rem;
            font-size: 1.25rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--accent-yellow);
        }

        .contact-btn {
            background-color: var(--sky-blue);
            color: var(--soccer-ball);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-weight: 600;
        }

        .contact-btn:hover {
            background-color: var(--accent-yellow);
            color: var(--soccer-ball);
            transform: translateY(-2px);
        }

        .copyright {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 3rem;
            padding-top: 2rem;
        }
      /* Nuevos estilos para el texto llamativo */
.hero-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 800;
    font-size: 4.5rem;
    letter-spacing: -1px;
    background: linear-gradient(45deg, var(--field-line), var(--grass-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin-bottom: 1.5rem;
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    font-family: 'Poppins', sans-serif;
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--sky-blue);
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    margin-bottom: 2rem;
    animation: fadeInUp 1s ease-out 0.3s backwards;
}
    </style>
</head>
<body>
    <!-- Enhanced Header -->
    <header class="main-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="inicio.php">
                    <img src="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" alt="Sport Space Logo" class="img-fluid" style="width: 90px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-home me-1"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-futbol me-1"></i> Canchas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-info-circle me-1"></i> Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-phone me-1"></i> Contacto</a>
                        </li>
                    </ul>
                    <div class="auth-buttons">
                        <a href="view/paginas/login.php" class="btn btn-outline-light me-2">
                            <i class="fas fa-sign-in-alt me-1"></i> Iniciar sesión
                        </a>
                        <a href="view/paginas/resgistro.php" class="btn btn-light text-primary">
                            <i class="fas fa-user-plus me-1"></i> Registrarse
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero section -->
    <section class="hero-section">
        <div class="container hero-content text-center">
        <h1 class="hero-title">SPORT SPACE</h1>
            <h1 class="display-4 fw-bold mb-3">Reserva tu cancha al instante</h1>
            <p class="lead mb-5">Explorá las canchas disponibles en tu ciudad y en tiempo real.</p>
            
            <div class="search-bar">
                <form action="view/paginas/login.php" class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
                            <input type="text" class="form-control border-0" placeholder="Cargando Ubicación...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0"><i class="fas fa-futbol text-muted"></i></span>
                            <input type="text" class="form-control border-0" placeholder="Elige deporte">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                            <input type="text" class="form-control border-0" placeholder="Mañana 22/10">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0"><i class="fas fa-clock text-muted"></i></span>
                            <input type="text" class="form-control border-0" placeholder="20:00hs">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Buscar canchas</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- América section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="section-title mb-4">Ponemos la tecnología al servicio del DEPORTE en nuestro País</h2>
                    <p class="mb-4">Estamos presentes en Santa Ana, El Salvador.</p>
                    <div class="d-flex align-items-center mb-4">
                        <img src="https://flagcdn.com/w80/sv.png" alt="El Salvador" class="img-fluid me-3" style="width: 60px;">
                        <span>El Salvador</span>
                    </div>
                    <a href="#" class="btn btn-outline-primary">Quiero que llegue a mi departamento</a>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1589487391730-58f20eb2c308?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2074&q=80" alt="Mapa" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Misión y visión -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title section-title mb-3">Misión</h2>
                            <p class="card-text">
                                Nuestra misión es ofrecer productos y servicios de alta calidad, promoviendo el crecimiento económico sostenible y generando valor a nuestros clientes, empleados y accionistas, a través de la innovación y el compromiso con la excelencia.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title section-title mb-3">Visión</h2>
                            <p class="card-text">
                                Nuestra visión es ser líderes en el mercado global, reconocidos por nuestro impacto positivo en la sociedad y el medio ambiente, manteniendo un enfoque en la innovación, la calidad y la responsabilidad social.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Descubre más servicios -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1624880357913-a8539238245b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Servicios" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4"><span class="section-title">Descubre</span> más servicios</h2>
                    <p class="mb-4">Aquí puedes encontrar más información sobre nuestros servicios, tarifas y beneficios. Aprovecha las mejores ofertas en alquiler de canchas y suscripciones.</p>
                    <a href="#" class="btn btn-primary">Ver más servicios</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="modern-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <img src="/AMACSS_SOFT41C-GP3/view/paginas/img/Logotipo blanco.png" alt="Sport Space Logo" class="img-fluid mb-4" style="width: 150px;">
                    <p class="text-muted">
                        Conectamos deportistas con las mejores instalaciones deportivas. Reserva tu cancha de manera fácil y rápida.
                    </p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <h4 class="footer-title">Enlaces Rápidos</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Inicio</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Nosotros</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Servicios</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right me-2"></i>Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h4 class="footer-title">Servicios</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-futbol me-2"></i>Reserva de Canchas</a></li>
                        <li><a href="#"><i class="fas fa-users me-2"></i>Torneos</a></li>
                        <li><a href="#"><i class="fas fa-star me-2"></i>Membresías</a></li>
                        <li><a href="#"><i class="fas fa-handshake me-2"></i>Alianzas</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h4 class="footer-title">Contacto</h4>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i>Santa Ana, El Salvador</li>
                        <li><i class="fas fa-phone me-2"></i>+503 7777-7777</li>
                        <li><i class="fas fa-envelope me-2"></i>sportspace@gmail.com</li>
                    </ul>
                    <button class="contact-btn mt-3">
                        <i class="fas fa-paper-plane me-2"></i>Contáctanos
                    </button>
                </div>
            </div>
            <div class="copyright text-center">
                <p class="mb-0">© 2024 Sport Space. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>