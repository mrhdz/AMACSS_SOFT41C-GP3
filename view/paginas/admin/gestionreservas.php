
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
    </header></div><br><br>
   
    <main class="container my-5">
        <h2 class="text-center">Gestión de Reservas</h2>
        <?php if ($reservas): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Reserva</th>
                        <th>Usuario</th>
                        <th>Cancha</th>
                        <th>Fecha de Reserva</th>
                        <th>Duración</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['id_reserva']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['usuario_nombre']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['cancha_nombre']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_reserva']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['duracion']); ?> horas</td>
                            <td><?php echo htmlspecialchars($reserva['estado']); ?></td>
                            <td>
                                <!-- Botón para editar reserva -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal<?php echo $reserva['id_reserva']; ?>">Editar</button>
                                
                                <!-- Modal para editar la reserva -->
                                <div class="modal fade" id="editarModal<?php echo $reserva['id_reserva']; ?>" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editarModalLabel">Editar Reserva</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="gestionreservas.php" method="post">
                                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha de Reserva</label>
                                                        <input type="datetime-local" class="form-control" name="fecha" value="<?php echo htmlspecialchars($reserva['fecha_reserva']); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="duracion">Duración (horas)</label>
                                                        <input type="number" class="form-control" name="duracion" value="<?php echo htmlspecialchars($reserva['duracion']); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estado">Estado</label>
                                                        <select class="form-control" name="estado" required>
                                                            <option value="confirmada" <?php echo $reserva['estado'] == 'confirmada' ? 'selected' : ''; ?>>Confirmada</option>
                                                            <option value="cancelada" <?php echo $reserva['estado'] == 'cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                                                            <option value="modificada" <?php echo $reserva['estado'] == 'modificada' ? 'selected' : ''; ?>>Modificada</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botón para eliminar reserva -->
                                <form action="gestionreservas.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id_reserva" value="<?php echo $reserva['id_reserva']; ?>">
                                    <button type="submit" name="eliminar" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta reserva?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No hay reservas disponibles.</p>
        <?php endif; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
