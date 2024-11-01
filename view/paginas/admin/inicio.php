
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
    <main>

            <!-- Bienvenida Administrador -->
            <div class="container text-center mt-5">
                <div class="jumbotron">
                    <h1 class="display-4">¡Bienvenido, Administrador!</h1>
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


        

