<?php
require_once("../../controller/canchaController.php");
$canchaController = new CanchaController();
$canchas = $canchaController->obtenerTodasLasCanchas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Canchas - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2 class="mb-4">Mapa de Canchas</h2>
        <div id="map"></div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([13.7942, -88.8965], 8); // Coordenadas centradas en El Salvador

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        <?php foreach ($canchas as $cancha): ?>
            L.marker([<?php echo $cancha['latitud']; ?>, <?php echo $cancha['longitud']; ?>])
             .addTo(map)
             .bindPopup("<?php echo $cancha['nombre']; ?>");
        <?php endforeach; ?>
    </script>
</body>
</html>