    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="inicio.php">Administrador</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="gestionusuarios.php">Gestión de Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestioncanchas.php">Gestión de Canchas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestionreservas.php">Gestión de Reservas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="historialreservas.php">Historial de Reservas</a>
                </li>
                <form action="logout.php" method="POST">
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>

            </ul>
        </div>
        
    </nav>



