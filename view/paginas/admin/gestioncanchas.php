<?php
session_start();
// Supongamos que conexion.php está en la carpeta model
require_once("../model/conexion.php"); // Ajusta esto según tu estructura de carpetas

$id_admin = $_SESSION['id_usuario']; // Asegúrate de que el ID de usuario esté almacenado en la sesión
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
    <main>
        <section id="gestionCanchas" class="mt-5">
            <h2>Gestión de Canchas</h2>
            <p>Aquí puedes ver, editar o eliminar canchas.</p>
            <button class="btn btn-primary" onclick="window.location.href='agregarCancha.php'">Agregar Cancha</button>
            <!-- Tabla de canchas -->
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Capacidad</th>
                        <th>Disponibilidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                session_start();
                require_once '../../model/conexion.php'; // Ruta a tu archivo de conexión

                $id_admin = $_SESSION['id_usuario']; // ID del administrador desde la sesión
                
                // Consulta para obtener canchas del administrador específico
                $query = "SELECT * FROM canchas WHERE id_propietario = ?";
                $stmt = $conexion->prepare($query);
                $stmt->bind_param("i", $id_admin);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Mostrar las canchas en la vista
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>"; // Cambié <p> a <tr> para que sea parte de la tabla
                    echo "<td>" . $row['id_cancha'] . "</td>"; // Añadido ID de la cancha
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['tipo'] . "</td>";
                    echo "<td>" . $row['capacidad'] . "</td>";
                    echo "<td>" . $row['disponibilidad'] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-warning'>Editar</button>"; // Botón de edición
                    echo "<button class='btn btn-danger'>Eliminar</button>"; // Botón de eliminación
                    echo "</td>";
                    echo "</tr>"; // Cerrando la fila de la tabla
                }
                
                $stmt->close(); // Cerrar la declaración
                ?>
            </tbody>

            </table>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
