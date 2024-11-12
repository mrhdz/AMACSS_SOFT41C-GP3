<?php
session_start();
require_once("../../controller/canchaController.php");
require_once("../../controller/problemaController.php");

$canchaController = new CanchaController();
$problemaController = new ProblemaController();

$id_cancha = $_GET['id'];
$cancha = $canchaController->obtenerCancha($id_cancha);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id_usuario'];

    $resultado = $problemaController->reportarProblema($id_cancha, $id_usuario, $descripcion);
    if ($resultado) {
        $mensaje = "Problema reportado exitosamente.";
    } else {
        $error = "Error al reportar el problema.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Problema - <?php echo $cancha['nombre']; ?> - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Reportar Problema - <?php echo $cancha['nombre']; ?></h2>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-success"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción del Problema</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Reporte</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>