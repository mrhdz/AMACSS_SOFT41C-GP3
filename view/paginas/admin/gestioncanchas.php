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

$cancha =new Cancha();
if (isset($_POST['ok1'])) {
    $cancha = new Cancha();
    $cancha->setIdCancha($_POST["id_cancha"]);
    $cancha->setIdPropietario($_POST["id_usuario"]);
    $cancha->setNombre($_POST["nombre"]);
    $cancha->setTipo($_POST["tipo"]);
    $cancha->setCapacidad($_POST["capacidad"]);
    $cancha->setDescripcion($_POST["descripcion"]);
    $cancha->setPrecio($_POST["precio"]);
    $cancha->setUrl($_POST["url"]);
    $cancha->setDisponibilidad($_POST["disponibilidad"]);

    $canchaController = new CanchaController();
    $canchaController->agregar($cancha);
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
    <main>
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
                                <label for="url">URL de Imagen</label>
                                <input type="url" class="form-control" id="url" name="url">
                            </div>
                            <div class="form-group">
                                <label for="disponibilidad">Disponibilidad</label>
                                <select class="form-control" id="disponibilidad" name="disponibilidad">
                                    <option value="disponible">Disponible</option>
                                    <option value="reservada">Reservada</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="enviar">Agregar Cancha</button>
                        </form>
                    </div>

                    <!-- Tabla para mostrar canchas registradas -->
                    <div class="col-md-7">
                        <h3>Canchas Registradas</h3>
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Capacidad</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Disponibilidad</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            <td><img src='{$cancha->getUrl()}' alt='Imagen del destino' style='width: 100px;' /></td>
                                            <td>{$cancha->getDisponibilidad()}</td>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
