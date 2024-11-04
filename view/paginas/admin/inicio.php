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
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
         <!-- place navbar here -->
        <?php 
            require_once("menuadmin.php");
        ?>
    </header>
    <!-- Background image -->
    <div class="position-absolute top-0 start-0 w-100 h-100">
            <img src="../img/background.jpg" class="img-fluid w-100 h-100" style="object-fit: cover;">
        </div><br><br><br><br>
        <main class="container my-5" style="margin-top: 80px;">
            <!-- Bienvenida Administrador -->
            <div class="container text-center mt-5 position-relative z-1 min-vh-100 d-flex flex-column">
                <div class="jumbotron">
                    <h1 class="display-4">¡Bienvenido, <?php echo htmlspecialchars($usuarioNombre); ?>!</h1>
                    <p class="lead">Gracias por iniciar sesión en el Panel de Administración. Aquí puedes gestionar usuarios, canchas y reservas.</p>
                    <hr class="my-4">
                    <p>Utiliza el menú superior para acceder a las distintas secciones y administrar los recursos de manera eficiente.</p>
                    <a class="btn btn-primary btn-lg" href="#gestionUsuarios" role="button">Comenzar</a>
                </div>
            </div>
        </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
