<?php
// Activar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/torneoController.php');

// Check if user is logged in
if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
    header("Location: ../../login.php");
    exit();
}

$torneoController = new TorneoController();
$canchasDisponibles = [];
$error = '';
$mensaje = '';

try {
    $canchasDisponibles = $torneoController->obtenerCanchasDisponiblesParaUsuario($_SESSION['id_usuario']);
} catch (Exception $e) {
    error_log("Error al obtener canchas disponibles: " . $e->getMessage());
    $error = "Ocurrió un error al cargar las canchas disponibles. Por favor, inténtalo de nuevo más tarde.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'crear':
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
                $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
                $id_cancha = filter_input(INPUT_POST, 'id_cancha', FILTER_VALIDATE_INT);
                $id_reserva = filter_input(INPUT_POST, 'id_reserva', FILTER_VALIDATE_INT);

                if ($nombre && $fecha && $id_cancha && $id_reserva) {
                    try {
                        $result = $torneoController->crearTorneo($nombre, $fecha, $id_cancha, $_SESSION['id_usuario'], $id_reserva);
                        if ($result['success']) {
                            $mensaje = $result['message'];
                        } else {
                            $error = $result['message'];
                        }
                    } catch (Exception $e) {
                        error_log("Error al crear torneo: " . $e->getMessage());
                        $error = "Ocurrió un error al crear el torneo. Por favor, inténtalo de nuevo.";
                    }
                } else {
                    $error = 'Por favor, completa todos los campos correctamente.';
                }
                break;

            case 'editar':
                $id_torneo = filter_input(INPUT_POST, 'id_torneo', FILTER_VALIDATE_INT);
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
                $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);

                if ($id_torneo && $nombre && $fecha) {
                    $result = $torneoController->editarTorneo($id_torneo, $nombre, $fecha);
                    if ($result['success']) {
                        $mensaje = $result['message'];
                    } else {
                        $error = $result['message'];
                    }
                } else {
                    $error = 'Datos inválidos para editar el torneo.';
                }
                break;

            case 'eliminar':
                $id_torneo = filter_input(INPUT_POST, 'id_torneo', FILTER_VALIDATE_INT);

                if ($id_torneo) {
                    $result = $torneoController->eliminarTorneo($id_torneo);
                    if ($result['success']) {
                        $mensaje = $result['message'];
                    } else {
                        $error = $result['message'];
                    }
                } else {
                    $error = 'ID de torneo inválido.';
                }
                break;

            case 'eliminar_participante':
                $id_torneo = filter_input(INPUT_POST, 'id_torneo', FILTER_VALIDATE_INT);
                $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

                if ($id_torneo && $id_usuario) {
                    $result = $torneoController->eliminarParticipante($id_torneo, $id_usuario, $_SESSION['id_usuario']);
                    if ($result['success']) {
                        $mensaje = $result['message'];
                    } else {
                        $error = $result['message'];
                    }
                } else {
                    $error = 'Datos inválidos para eliminar el participante.';
                }
                break;
        }
    }
}

// Obtener los torneos creados por el usuario
$misTorneos = $torneoController->obtenerTorneosCreados($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Torneo - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <meta name="description" content="Crea un nuevo torneo en Sport Space">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --accent-color: #FFF176;
            --background-color: #E8F5E9;
            --text-color: #333333;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .card-header {
            background-color: var(--primary-color);
            color: #ffffff;
            border-radius: 15px 15px 0 0;
            padding: 1rem;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .table {
            background-color: #ffffff;
            border-radius: 15px;
            overflow: hidden;
        }
        .table th {
            background-color: var(--primary-color);
            color: #ffffff;
        }
        .footer {
            background-color: var(--primary-color);
            color: #ffffff;
            padding: 1rem 0;
            margin-top: auto;
        }
       
        .navbar-brand {
            color: #ffffff !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            color: #ffffff !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: var(--accent-color) !important;
        }
        .hero-section {
            background-image: url('https://images.unsplash.com/photo-1529900748604-07564a03e7a6?q=80&w=1470&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .hero-title {
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
        }
        
    </style>
</head>
<body>
<header>
        <?php require_once("menuUs.php"); ?>
    </header>


    <!-- Hero section -->
    <div class="hero-section">
        <h1 class="hero-title">Gestión de Torneos de Fútbol</h1>
    </div>

    <div class="container">
        <?php if ($mensaje): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title mb-0">Crear Nuevo Torneo</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="crear">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Torneo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required minlength="3" maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha del Torneo</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="id_cancha" class="form-label">Cancha</label>
                                <select class="form-select" id="id_cancha" name="id_cancha" required>
                                    <option value="">Selecciona una cancha</option>
                                    <?php
                                    $currentDate = '';
                                    foreach ($canchasDisponibles as $cancha):
                                        $canchaDate = date('Y-m-d', strtotime($cancha['fecha_reserva']));
                                        if ($canchaDate != $currentDate):
                                            if ($currentDate != '') echo '</optgroup>';
                                            echo '<optgroup label="' . date('d/m/Y', strtotime($canchaDate)) . '">';
                                            $currentDate = $canchaDate;
                                        endif;
                                    ?>
                                        <option value="<?php echo $cancha['id_cancha']; ?>" data-reserva="<?php echo $cancha['id_reserva']; ?>">
                                            <?php echo htmlspecialchars($cancha['cancha_nombre'] . ' - ' . $cancha['hora_inicio'] . ' - ' . $cancha['hora_fin'] . ' (Reserva aprobada)'); ?>
                                        </option>
                                    <?php
                                    endforeach;
                                    if ($currentDate != '') echo '</optgroup>';
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" id="id_reserva" name="id_reserva">

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle me-2"></i>Crear Torneo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title mb-0">Mis Torneos Creados</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Cancha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($misTorneos as $torneo): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($torneo['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($torneo['fecha']); ?></td>
                                            <td><?php echo htmlspecialchars($torneo['nombre_cancha']); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editarTorneoModal" data-id="<?php echo $torneo['id']; ?>" data-nombre="<?php echo htmlspecialchars($torneo['nombre']); ?>" data-fecha="<?php echo $torneo['fecha']; ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display: inline;">
                                                    <input type="hidden" name="action" value="eliminar">
                                                    <input type="hidden" name="id_torneo" value="<?php echo $torneo['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este torneo?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#verParticipantesModal" data-id="<?php echo $torneo['id']; ?>" data-nombre="<?php echo htmlspecialchars($torneo['nombre']); ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar torneo -->
    <div class="modal fade" id="editarTorneoModal" tabindex="-1" aria-labelledby="editarTorneoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarTorneoModalLabel">Editar Torneo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="editar">
                        <input type="hidden" id="editTorneoId" name="id_torneo">
                        <div class="mb-3">
                            <label for="editNombre" class="form-label">Nombre del Torneo</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="editFecha" class="form-label">Fecha del Torneo</label>
                            <input type="date" class="form-control" id="editFecha" name="fecha" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para ver participantes -->
    <div class="modal fade" id="verParticipantesModal" tabindex="-1" aria-labelledby="verParticipantesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verParticipantesModalLabel">Participantes del Torneo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="nombreTorneo"></h6>
                    <ul id="listaParticipantes" class="list-group">
                        <!-- Los participantes se cargarán aquí dinámicamente -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center py-3">
        <div class="container">
            <p>&copy; 2024 Sport Space. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('id_cancha').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById('id_reserva').value = selectedOption.getAttribute('data-reserva');
        });

        // Bootstrap form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Funcionalidad para el modal de editar torneo
        var editarTorneoModal = document.getElementById('editarTorneoModal')
        editarTorneoModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var nombre = button.getAttribute('data-nombre')
            var fecha = button.getAttribute('data-fecha')

            var modalTitle = editarTorneoModal.querySelector('.modal-title')
            var idInput = editarTorneoModal.querySelector('#editTorneoId')
            var nombreInput = editarTorneoModal.querySelector('#editNombre')
            var fechaInput = editarTorneoModal.querySelector('#editFecha')

            modalTitle.textContent = 'Editar Torneo: ' + nombre
            idInput.value = id
            nombreInput.value = nombre
            fechaInput.value = fecha
        })

        // Funcionalidad para el modal de ver participantes
        var verParticipantesModal = document.getElementById('verParticipantesModal')
        verParticipantesModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var nombre = button.getAttribute('data-nombre')

            var modalTitle = verParticipantesModal.querySelector('.modal-title')
            var nombreTorneo = verParticipantesModal.querySelector('#nombreTorneo')
            var listaParticipantes = verParticipantesModal.querySelector('#listaParticipantes')

            modalTitle.textContent = 'Participantes del Torneo'
            nombreTorneo.textContent = nombre
            listaParticipantes.innerHTML = '<li class="list-group-item">Cargando participantes...</li>'

            fetch('obtener_participantes.php?id_torneo=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        listaParticipantes.innerHTML = ''
                        data.participantes.forEach(participante => {
                            var li = document.createElement('li')
                            li.className = 'list-group-item d-flex justify-content-between align-items-center'
                            li.textContent = participante.nombre
                            var deleteButton = document.createElement('button')
                            deleteButton.className = 'btn btn-sm btn-danger'
                            deleteButton.innerHTML = '<i class="bi bi-trash"></i>'
                            deleteButton.onclick = function() {
                                if (confirm('¿Estás seguro de que quieres eliminar este participante?')) {
                                    var form = document.createElement('form')
                                    form.method = 'POST'
                                    form.action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'
                                    var actionInput = document.createElement('input')
                                    actionInput.type = 'hidden'
                                    actionInput.name = 'action'
                                    actionInput.value = 'eliminar_participante'
                                    var torneoIdInput = document.createElement('input')
                                    torneoIdInput.type = 'hidden'
                                    torneoIdInput.name = 'id_torneo'
                                    torneoIdInput.value = id
                                    var userIdInput = document.createElement('input')
                                    userIdInput.type = 'hidden'
                                    userIdInput.name = 'id_usuario'
                                    userIdInput.value = participante.id_usuario
                                    form.appendChild(actionInput)
                                    form.appendChild(torneoIdInput)
                                    form.appendChild(userIdInput)
                                    document.body.appendChild(form)
                                    form.submit()
                                }
                            }
                            li.appendChild(deleteButton)
                            listaParticipantes.appendChild(li)
                        })
                        if (data.participantes.length === 0) {
                            listaParticipantes.innerHTML = '<li class="list-group-item">No hay participantes en este torneo.</li>'
                        }
                    } else {
                        listaParticipantes.innerHTML = '<li class="list-group-item">Error al cargar los participantes.</li>'
                    }
                })
                .catch(error => {
                    console.error('Error:', error)
                    listaParticipantes.innerHTML = '<li class="list-group-item">Error al cargar los participantes.</li>'
                })
        })
    </script>
</body>
</html>