<?php
session_start();
require_once("../../controller/canchaController.php");
require_once("../../controller/torneoController.php");

$canchaController = new CanchaController();
$torneoController = new TorneoController();

$canchas = $canchaController->obtenerCanchasDelAdministrador($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Panel de Control</h2>
        <?php foreach ($canchas as $cancha): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h3><?php echo $cancha['nombre']; ?></h3>
                </div>
                <div class="card-body">
                    <h4>Eventos</h4>
                    <?php
                    $eventos = $torneoController->obtenerEventosPorCancha($cancha['id_cancha']);
                    if (count($eventos) > 0):
                    ?>
                        <ul class="list-group">
                            <?php foreach ($eventos as $evento): ?>
                                <li class="list-group-item">
                                    <strong><?php echo $evento['nombre']; ?></strong>
                                    <br>
                                    Fecha: <?php echo $evento['fecha']; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No hay eventos programados para esta cancha.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>