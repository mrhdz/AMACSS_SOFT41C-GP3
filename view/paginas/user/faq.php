<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes - Sport Space</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        h1, h2, h3 {
            color: #2E7D32;
        }
        .navbar {
            background-color: #4CAF50;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .footer {
            background-color: #2E7D32;
            color: #ffffff;
            padding: 20px 0;
            margin-top: auto;
        }
        .accordion-button:not(.collapsed) {
            background-color: #e8f5e9;
            color: #2E7D32;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once("menuUs.php"); ?>
    </header>

    <div class="container mt-4">
        <h1 class="mb-4">Preguntas Frecuentes</h1>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        ¿Cómo puedo reservar una cancha?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Para reservar una cancha, inicia sesión en tu cuenta, selecciona la cancha deseada, elige la fecha y hora disponible, y confirma tu reserva. El pago se puede realizar en línea o en el lugar al momento de usar la cancha.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        ¿Cuál es la política de cancelación?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Puedes cancelar tu reserva hasta 24 horas antes de la hora programada sin costo alguno. Las cancelaciones realizadas con menos de 24 horas de anticipación están sujetas a un cargo del 50% del costo de la reserva.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        ¿Qué debo llevar para usar la cancha?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Debes llevar tu propio equipo deportivo (balones, raquetas, etc.) y ropa adecuada para la actividad. Las canchas cuentan con vestidores y duchas. Te recomendamos llevar una botella de agua y una toalla.
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h3>Hacer una nueva pregunta</h3>
            <form>
                <div class="mb-3">
                    <label for="nueva_pregunta" class="form-label">Tu pregunta:</label>
                    <textarea class="form-control" id="nueva_pregunta" name="nueva_pregunta" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Pregunta</button>
            </form>
        </div>
    </div>

    <footer class="footer text-center py-3">
        <div class="container">
            <p>&copy; 2024 Sport Space - Alquiler de Locales Deportivos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>