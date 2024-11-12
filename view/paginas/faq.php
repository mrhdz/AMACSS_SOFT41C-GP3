<?php
session_start();
require_once("../../controller/faqController.php");

$faqController = new FAQController();
$preguntas = $faqController->obtenerTodasLasPreguntas();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nueva_pregunta'])) {
        $pregunta = $_POST['nueva_pregunta'];
        $id_usuario = $_SESSION['id_usuario'];
        $faqController->agregarPregunta($pregunta, $id_usuario);
    } elseif (isset($_POST['respuesta']) && isset($_POST['id_pregunta'])) {
        $respuesta = $_POST['respuesta'];
        $id_pregunta = $_POST['id_pregunta'];
        $id_usuario = $_SESSION['id_usuario'];
        $faqController->agregarRespuesta($id_pregunta, $respuesta, $id_usuario);
    }
    header("Location: faq.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes - Sport Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Preguntas Frecuentes</h2>
        <div class="accordion" id="faqAccordion">
            <?php foreach ($preguntas as $index => $pregunta): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                            <?php echo $pregunta['pregunta']; ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?php if ($pregunta['respuesta']): ?>
                                <p><?php echo $pregunta['respuesta']; ?></p>
                            <?php else: ?>
                                <p>Aún no hay respuesta para esta pregunta.</p>
                                <form method="POST">
                                    <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['id']; ?>">
                                    <div class="mb-3">
                                        <label for="respuesta<?php echo $index; ?>" class="form-label">Responder:</label>
                                        <textarea class="form-control" id="respuesta<?php echo $index; ?>" name="respuesta" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-4">
            <h3>Hacer una nueva pregunta</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="nueva_pregunta" class="form-label">Tu pregunta:</label>
                    <textarea class="form-control" id="nueva_pregunta" name="nueva_pregunta" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Pregunta</button>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>