<?php
include '../../model/conexion.php'; // Asegúrate de que la ruta sea correcta

// Crear una instancia de la conexión
$conexion = new conexion(); // Aquí se crea la instancia correctamente

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = $_POST['rol'];

    // Verificar si el correo ya existe en la base de datos
    $sqlCheck = "SELECT email FROM usuarios WHERE email = ?";
    $stmtCheck = $conexion->cn()->prepare($sqlCheck);
    if ($stmtCheck) {
        $stmtCheck->bind_param("s", $email);
        $stmtCheck->execute();
        $stmtCheck->store_result();

        if ($stmtCheck->num_rows > 0) {
            echo "<div class='alert alert-warning'>El correo electrónico ya está registrado. Por favor, intenta con uno diferente.</div>";
        } else {
            // Insertar los datos si el correo no existe
            $sql = "INSERT INTO usuarios (nombre, email, telefono, password, rol) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->cn()->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssss", $nombre, $email, $telefono, $password, $rol);
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Registro exitoso</div>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
                }
                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Error al preparar la consulta: " . $conexion->cn()->error . "</div>";
            }
        }
        $stmtCheck->close();
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la consulta de verificación: " . $conexion->cn()->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para centrar el formulario */
        .form-container {
            max-width: 400px; /* Ancho máximo del formulario */
            margin: 0 auto;   /* Centrar horizontalmente */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Registro de Usuario</h2>
    <div class="form-container">
        <form action="" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="usuario_normal" selected>Usuario Normal</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
