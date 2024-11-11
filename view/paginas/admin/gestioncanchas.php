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
}
// Verifica si se envió el formulario de eliminación
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
    <title>Gestión de Canchas - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --accent-color: #FFF176;
            --background-color: #2E7D32;
            --text-color: #ffffff;
            --dark-text: #212121;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e8f5e9;
            color: var(--dark-text);
        }

        .navbar {
            background-color: var(--background-color);
        }

        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            color: var(--text-color);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: var(--text-color);
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }

        .table {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: var(--primary-color);
            color: var(--text-color);
        }

        .footer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px 0;
            margin-top: 3rem;
        }

        .form-floating > label {
            left: 10px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(76, 175, 80, 0.1);
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuadmin.php"); ?>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold"><?php echo htmlspecialchars($usuarioNombre); ?>, Gestiona tus Canchas</h1>
            <p class="lead">Agrega, edita y administra tus instalaciones deportivas</p>
        </div>
    </section>

    <main class="container my-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4"><i class="bi bi-plus-circle-fill text-primary me-2"></i>Agregar Cancha</h3>
                        <form action="" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                <label for="nombre"><i class="bi bi-tag me-2"></i>Nombre de la Cancha</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="Artificial">Artificial</option>
                                    <option value="Fútbol Rápido">Fútbol Rápido</option>
                                    <option value="Césped Natural">Césped Natural</option>
                                    <option value="Sala">Sala</option>
                                    <option value="Multideporte">Multideporte</option>
                                </select>
                                <label for="tipo"><i class="bi bi-diagram-2 me-2"></i>Tipo de Cancha</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="capacidad" name="capacidad" placeholder="Capacidad" required>
                                <label for="capacidad"><i class="bi bi-people me-2"></i>Capacidad</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height: 100px"></textarea>
                                <label for="descripcion"><i class="bi bi-card-text me-2"></i>Descripción</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Precio">
                                <label for="precio"><i class="bi bi-currency-dollar me-2"></i>Precio</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="urlImagen" name="urlImagen" placeholder="URL de la imagen" required>
                                <label for="urlImagen"><i class="bi bi-image me-2"></i>URL de la imagen</label>
                            </div>
                            <button type="submit" class="btn btn-custom w-100" name="enviar">
                                <i class="bi bi-plus-circle me-2"></i>Agregar Cancha
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4"><i class="bi bi-list-ul text-primary me-2"></i>Canchas Registradas</h3>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Capacidad</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($canchaController->listar($usuarioId) as $cancha) {
                                        echo "<tr>
                                                <td>{$cancha->getIdCancha()}</td>
                                                <td>{$cancha->getNombre()}</td>
                                                <td>{$cancha->getTipo()}</td>
                                                <td>{$cancha->getCapacidad()}</td>
                                                <td>\${$cancha->getPrecio()}</td>
                                                <td><img src='{$cancha->getUrlImagen()}' alt='Imagen de la cancha' class='img-thumbnail' style='width: 50px; height: 50px; object-fit: cover;' /></td>
                                                <td>
                                                    <button onclick='abrirModalEditar({
                                                        id: \"{$cancha->getIdCancha()}\",
                                                        nombre: \"{$cancha->getNombre()}\",
                                                        tipo: \"{$cancha->getTipo()}\",
                                                        capacidad: \"{$cancha->getCapacidad()}\",
                                                        descripcion: \"{$cancha->getDescripcion()}\",
                                                        precio: \"{$cancha->getPrecio()}\",
                                                        urlImagen: \"{$cancha->getUrlImagen()}\"
                                                    })' class='btn btn-warning btn-icon me-2'>
                                                        <i class='bi bi-pencil-fill'></i>
                                                    </button>
                                                    <form class='d-inline' method='post' action=''>
                                                        <input type='hidden' name='idCancha' value='{$cancha->getIdCancha()}'>
                                                        <button type='submit' name='deleteBtn' class='btn btn-danger btn-icon' onclick='return confirm(\"¿Estás seguro de que quieres eliminar esta cancha?\");'>
                                                            <i class='bi bi-trash-fill'></i>
                                                        </button>
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
            </div>
        </div>
    </main>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square me-2"></i>Modificar Información de la Cancha</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <input type="hidden" name="idCancha" id="editIdCancha">
                        <div class="form-floating mb-3">
                            <input type="text" name="nombre" class="form-control" id="editNombre" placeholder="Nombre" required>
                            <label for="editNombre"><i class="bi bi-tag me-2"></i>Nombre de la Cancha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="editTipo" name="tipo" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="Artificial">Artificial</option>
                                <option value="Fútbol Rápido">Fútbol Rápido</option>
                                <option value="Césped Natural">Césped Natural</option>
                                <option value="Sala">Sala</option>
                                <option value="Multideporte">Multideporte</option>
                            </select>
                            <label for="editTipo"><i class="bi bi-diagram-2 me-2"></i>Tipo de Cancha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="capacidad" class="form-control" id="editCapacidad" placeholder="Capacidad" required>
                            <label for="editCapacidad"><i class="bi bi-people me-2"></i>Capacidad</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="descripcion" class="form-control" id="editDescripcion" placeholder="Descripción" style="height: 100px"></textarea>
                            <label for="editDescripcion"><i class="bi bi-card-text me-2"></i>Descripción</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" step="0.01" name="precio" class="form-control" id="editPrecio" placeholder="Precio">
                            <label for="editPrecio"><i class="bi bi-currency-dollar me-2"></i>Precio</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="urlImagen" class="form-control" id="editUrlImagen" placeholder="URL de la imagen">
                            <label for="editUrlImagen"><i class="bi bi-image me-2"></i>URL de la imagen</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name='editBtn'>
                            <i class="bi bi-save me-2"></i>Guardar Cambios
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2023 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function abrirModalEditar(cancha) {
            document.getElementById('editIdCancha').value = cancha.id;
            document.getElementById('editNombre').value = cancha.nombre;
            document.getElementById('editTipo').value = cancha.tipo;
            document.getElementById('editCapacidad').value = cancha.capacidad;
            document.getElementById('editDescripcion').value = cancha.descripcion;
            document.getElementById('editPrecio').value = cancha.precio;
            document.getElementById('editUrlImagen').value = cancha.urlImagen;
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }
    </script>
</body>
</html>