
    
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body><header>
         <!-- place navbar here -->
        <?php 
            require_once("menuadmin.php");
        ?>
    </header>
<section id="historialReservas" class="mt-5">
            <h2>Historial de Reservas</h2>
            <p>Revisa el historial de cambios en las reservas.</p>
            <!-- Tabla de historial de reservas -->
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>ID Reserva</th>
                        <th>Fecha de Modificación</th>
                        <th>Cambio</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se pueden agregar filas dinámicamente con datos del historial de reservas -->
                </tbody>
            </table>
        </section>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


        


    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
