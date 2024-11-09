<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}
$usuarioId = $_SESSION['id_usuario']; // Obtiene el ID del usuario desde la sesión
$usuarioNombre = $_SESSION['usuario']; // Obtiene el nombre del usuario de la sesión
// Asegúrate de que el ID de usuario esté almacenado en la sesión



include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/canchaController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/cancha.php');
$canchaController = new CanchaController();

// Verifica si se envió el formulario
if (isset($_POST['enviar'])) {
    $cancha = new Cancha();
    $cancha->setIdPropietario($usuarioId); // Asigna el ID del propietario desde la sesión
    $cancha->setNombre($_POST["nombre"]);
    $cancha->setTipo($_POST["tipo"]);
    $cancha->setCapacidad($_POST["capacidad"]);
    $cancha->setDescripcion($_POST["descripcion"]);
    $cancha->setPrecio($_POST["precio"]);
    $cancha->setUrlImagen($_POST["urlImagen"]);

    // Llama al método agregar del controlador
    $canchaController->agregar($cancha);

    // Redirige para evitar reenvío del formulario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}// Verifica si se envió el formulario de eliminación
else if (isset($_POST['deleteBtn'])) {
    $idCancha = $_POST['idCancha'];
    $canchaController->eliminar($idCancha); // Llama al método para eliminar la cancha
    header("Location: " . $_SERVER['PHP_SELF']); // Redirige para evitar reenvío de formulario
    exit();
}
else if (isset($_POST['editBtn'])) {
    $idCancha = $_POST['idCancha']; // Captura el ID de la cancha
    $cancha = new Cancha();
    $cancha->setIdCancha($idCancha);
    $cancha->setNombre($_POST["nombre"]);
    $cancha->setTipo($_POST["tipo"]);
    $cancha->setCapacidad($_POST["capacidad"]);
    $cancha->setDescripcion($_POST["descripcion"]);
    $cancha->setPrecio($_POST["precio"]);
    $cancha->setUrlImagen($_POST["urlImagen"]);

    $canchaController->actualizar($cancha); // Llama al método para actualizar la cancha
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* Estilos para compactar el formulario */
        .form-group {
            margin-bottom: 0.5rem;
        }
        #gestionCanchas h2, #gestionCanchas h3 {
            margin-bottom: 1rem;
        }
        /* Estilos para la tabla */
        .table thead th {
            font-size: 0.9rem;
            text-align: center;
        }
        .table tbody td {
            font-size: 0.85rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuadmin.php"); ?>
    </header>
    <main class="container my-5" style="margin-top: 80px;">
        <br><center>    <h2><?php echo htmlspecialchars($usuarioNombre); ?>, Aquí puedes ver, editar o eliminar canchas.</h2>
        </center>
        <section id="gestionCanchas" class="mt-5">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-5">
                        <h3>Agregar Cancha</h3>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nombre">Nombre de la Cancha</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo de Cancha</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" required>
                            </div>
                            <div class="form-group">
                                <label for="capacidad">Capacidad</label>
                                <input type="number" class="form-control" id="capacidad" name="capacidad" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio">
                            </div>
                            <div class="form-group">
                                <label for="urlImagen">URL de la imagen</label>
                                <input type="text" class="form-control" id="urlImagen" name="urlImagen" placeholder="https://ejemplo.com/imagen.jpg" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="enviar">Agregar Cancha</button>
                        </form>
                    </div>

                    <!-- Tabla para mostrar canchas registradas -->
                    <div class="col-md-7">
                        <h3>Canchas Registradas</h3>
                        <table class="table table-bordered table-hover" id="mi tabla">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Capacidad</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php
                                // Aquí agregarías el código PHP para obtener y mostrar las canchas de la base de datos.
                                foreach ($canchaController->listar($usuarioId) as $cancha) {
                                    echo "<tr>
                                            <td>{$cancha->getIdCancha()}</td>
                                            <td>{$cancha->getNombre()}</td>
                                            <td>{$cancha->getTipo()}</td>
                                            <td>{$cancha->getCapacidad()}</td>
                                            <td>{$cancha->getDescripcion()}</td>
                                            <td>{$cancha->getPrecio()}</td>
                                            <td><img src='{$cancha->getUrlImagen()}' alt='Imagen del destino' style='width: 100px;' /></td>
                                            <td>
                                            <a href='javascript:void(0);' onclick='abrirModalEditar({
                                                id: \"{$cancha->getIdCancha()}\",
                                                nombre: \"{$cancha->getNombre()}\",
                                                tipo: \"{$cancha->getTipo()}\",
                                                capacidad: \"{$cancha->getCapacidad()}\",
                                                descripcion: \"{$cancha->getDescripcion()}\",
                                                precio: \"{$cancha->getPrecio()}\",
                                                urlImagen: \"{$cancha->getUrlImagen()}\"
                                            })' class='btn btn-warning btn-sm'>Editar</a>
                                            
                                                <form class='d-inline' method='post' action=''>
                                                    <input type='hidden' name='idCancha' value='{$cancha->getIdCancha()}'>
                                                    <button type='submit' name='deleteBtn' class='btn btn-danger  btn-sm'>Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>";                                   
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modificar Información de la Cancha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="idCancha" id="editIdCancha">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre de la Cancha</label>
                        <input type="text" name="nombre" class="form-control" id="editNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTipo" class="form-label">Tipo de Cancha</label>
                        <input type="text" name="tipo" class="form-control" id="editTipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCapacidad" class="form-label">Capacidad</label>
                        <input type="number" name="capacidad" class="form-control" id="editCapacidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="editDescripcion" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPrecio" class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" id="editPrecio">
                    </div>
                    <div class="mb-3">
                        <label for="editUrlImagen" class="form-label">URL de la imagen</label>
                        <input type="text" name="urlImagen" class="form-control" id="editUrlImagen" placeholder="https://ejemplo.com/imagen.jpg">
                    </div>
                    <button type="submit" class="btn btn-primary" name='editBtn'>
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        function abrirModalEditar(cancha) {
        document.getElementById('editIdCancha').value = cancha.id;
        document.getElementById('editNombre').value = cancha.nombre;
        document.getElementById('editTipo').value = cancha.tipo;
        document.getElementById('editCapacidad').value = cancha.capacidad;
        document.getElementById('editDescripcion').value = cancha.descripcion;
        document.getElementById('editPrecio').value = cancha.precio;
        document.getElementById('editUrlImagen').value = cancha.urlImagen;
        $('#editModal').modal('show');
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
