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
    <title>Bienvenidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
         <!-- place navbar here -->
        <?php 
            require_once("menuUs.php");
        ?>
    </header>
    <main>

            <!-- Bienvenida Administrador -->
            <div class="container text-center mt-5">
                <div class="jumbotron">
                    <h1 class="display-4">¡Bienvenido, <?php echo htmlspecialchars($usuarioNombre); ?>!</h1>
                    <p class="lead">Gracias por iniciar sesión</p>
                    <hr class="my-4">
                    <p>Utiliza el menú superior para acceder a las distintas secciones y alquilar tu cancha.</p>
                    <a class="btn btn-primary btn-lg" href="listacanchas.php" role="button">Comenzar</a>
                </div>
            </div>
        </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
