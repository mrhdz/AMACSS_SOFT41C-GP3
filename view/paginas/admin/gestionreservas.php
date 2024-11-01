
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
<section id="gestionReservas" class="mt-5">
            <h2>Gestión de Reservas</h2>
            <p>Aquí puedes ver, editar o cancelar reservas.</p>
            <button class="btn btn-primary">Crear Reserva</button>
            <!-- Tabla de reservas -->
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cancha</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Duración</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se pueden agregar filas dinámicamente con datos de las reservas -->
                </tbody>
            </table>
        </section>

        </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


        


    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
