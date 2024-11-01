<header>
         <!-- place navbar here -->
        <?php 
            require_once("menuadmin.php");
        ?>
    </header>

<section id="gestionCanchas" class="mt-5">
            <h2>Gestión de Canchas</h2>
            <p>Aquí puedes ver, editar o eliminar canchas.</p>
            <button class="btn btn-primary">Agregar Cancha</button>
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
                    $id_admin = $_SESSION['id_usuario'];
                    
                    // Consulta para obtener canchas del administrador específico
                    $query = "SELECT * FROM canchas WHERE id_propietario = ?";
                    $stmt = $conexion->prepare($query);
                    $stmt->bind_param("i", $id_admin);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    // Mostrar las canchas en la vista
                    while ($row = $result->fetch_assoc()) {
                        echo "<p>Nombre de la cancha: " . $row['nombre'] . "</p>";
                        echo "<p>Tipo de cancha: " . $row['tipo'] . "</p>";
                        echo "<p>Capacidad: " . $row['capacidad'] . "</p>";
                        echo "<p>Precio: $" . $row['precio'] . "</p>";
                        echo "<p>Disponibilidad: " . $row['disponibilidad'] . "</p>";
                        echo "<hr>";
                    }
                    
                    ?>
                </tbody>
            </table>
        </section>
