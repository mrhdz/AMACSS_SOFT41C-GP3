<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../login.php"); // Redirige al login si no hay sesión
    exit();
}
$usuarioId = $_SESSION['id_usuario']; // Obtiene el ID del usuario desde la sesión
$usuarioNombre = $_SESSION['usuario']; // Obtiene el nombre del usuario de la sesión

include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/controller/canchaController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/AMACSS_SOFT41C-GP3/model/cancha.php');
$canchaController = new CanchaController();
$canchasDisponibles = $canchaController->listarDisponibles();
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
        .card {
            border: none;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            height: auto;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 0.9rem;
            color: #666;
        }
        .price {
            font-size: 1rem;
            font-weight: bold;
            color: #28a745;
        }
        .button {
        position: relative;
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 1px solid #34974d;
        background-color: #3aa856;
        }

        .button, .button__icon, .button__text {
        transition: all 0.3s;
        }

        .button .button__text {
        transform: translateX(30px);
        color: #fff;
        font-weight: 600;
        }

        .button .button__icon {
        position: absolute;
        transform: translateX(109px);
        height: 100%;
        width: 39px;
        background-color: #34974d;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .button .svg {
        width: 30px;
        stroke: #fff;
        }

        .button:hover {
        background: #34974d;
        }

        .button:hover .button__text {
        color: transparent;
        }

        .button:hover .button__icon {
        width: 148px;
        transform: translateX(0);
        }

        .button:active .button__icon {
        background-color: #2e8644;
        }

        .button:active {
        border: 1px solid #2e8644;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>
    <main>
        <br><center><h2><?php echo htmlspecialchars($usuarioNombre); ?>, Aquí puedes ver todas las canchas.</h2></center>
        <div class="container my-5">
            <h2 class="text-center mb-4">Lista de Canchas Disponibles</h2>
            <div class="row">
                <!-- Comienza el bucle de canchas -->
                <?php
                foreach ($canchasDisponibles as $cancha) {
                    echo "<div class='col-md-4'>
                            <div class='card'>
                                <img src='" . htmlspecialchars($cancha["urlImagen"]) . "' alt='Imagen de la cancha'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . htmlspecialchars($cancha["nombre"]) . "</h5>
                                    <p class='card-text'>Propietario: " . htmlspecialchars($cancha["propietario_nombre"]) . "</p>
                                    <p class='card-text'>Tipo: " . htmlspecialchars($cancha["tipo"]) . "</p>
                                    <p class='card-text'>Capacidad: " . htmlspecialchars($cancha["capacidad"]) . " personas</p>
                                    <p class='card-text'>Descripción: " . htmlspecialchars($cancha["descripcion"]) . "</p>
                                    <p class='price'>$" . htmlspecialchars($cancha["precio"]) . " por hora</p>
                                    <p class='card-text'>Disponibilidad: " . htmlspecialchars($cancha["disponibilidad"]) . "</p>
                                    <form action='procesar_reserva.php' method='post'>
                                        <button type='button' class='button'>
                                        <span class='button__text'>Alquilar</span>
                                        <span class='button__icon'><svg xmlns='http://www.w3.org/2000/svg' width='24' viewBox='0 0 24 24' stroke-width='2' stroke-linejoin='round' stroke-linecap='round' stroke='currentColor' height='24' fill='none' class='svg'><line y2='19' y1='5' x2='12' x1='12'></line><line y2='12' y1='12' x2='19' x1='5'></line></svg></span>
                                        </button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>";
                }
                ?>
                <!-- Fin del bucle de canchas -->
            </div>
        </div>
    </main>
    
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
