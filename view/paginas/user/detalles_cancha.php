<?php
session_start();
require_once("../../controller/canchaController.php");
require_once("../../controller/valoracionController.php");

$canchaController = new CanchaController();
$valoracionController = new ValoracionController();

$id_cancha = $_GET['id'];
$cancha = $canchaController->obtenerCancha($id_cancha);
$valoraciones = $valoracionController->obtenerValoracionesCancha($id_cancha);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $puntuacion = $_POST['puntuacion'];
    $comentario = $_POST['comentario'];
    $id_usuario = $_SESSION['id_usuario'];

    $resultado = $valoracionController->agregarValoracion($id_cancha, $id_usuario, $puntuacion, $comentario);
    if ($resultado) {
        $mensaje = "Valoración agregada exitosamente.";
    } else {
        $error = "Error al agregar la valoración.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cancha['nombre']; ?> - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2><?php echo $cancha['nombre']; ?></h2>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $cancha['urlImagen']; ?>" class="img-fluid" alt="<?php echo $cancha['nombre']; ?>">
            </div>
            <div class="col-md-6">
                <p><strong>Ubicación:</strong> <?php echo $cancha['ubicacion']; ?></p>
                <p><strong>Precio:</strong> $<?php echo $cancha['precio']; ?></p>
                <p><strong>Descripción:</strong> <?php echo $cancha['descripcion']; ?></p>
                <h3>Valoraciones</h3>
                <?php foreach ($valoraciones as $valoracion): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $valoracion['puntuacion']) {
                                        echo '<i class="fas fa-star text-warning"></i>';
                                    } else {
                                        echo '<i class="far fa-star text-warning"></i>';
                                    }
                                }
                                ?>
                            </h5>
                            <p class="card-text"><?php echo $valoracion['comentario']; ?></p>
                            <p class="card-text"><small class="text-muted">Por: <?php echo $valoracion['nombre_usuario']; ?></small></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <h4>Agregar Valoración</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label for="puntuacion" class="form-label">Puntuación</label>
                        <select class="form-select" id="puntuacion" name="puntuacion" required>
                            <option value="1">1 estrella</option>
                            <option value="2">2 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Valoración</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>