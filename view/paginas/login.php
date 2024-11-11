<?php
include '../../model/conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conexion = new Conexion();
    
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexion->cn()->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la declaración: " . $conexion->cn()->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($password, $usuario['PASSWORD'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            
            if ($usuario['rol'] === 'admin') {
                header("Location: admin/inicio.php");
            } else {
                header("Location: user/inicioUs.php");
            }
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El usuario no existe.";
    }
    $stmt->close();
    $conexion->cn()->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FÚTBOL RESERVAS - Login</title>
    <link rel="icon" href="/AMACSS_SOFT41C-GP3/view/paginas/img/Logo blanco.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            overflow-x: hidden;
        }

        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1556056504-5c7696c4c28d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2076&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.2;
            z-index: -1;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(10px);
            animation: cardAppear 0.5s ease-out;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-button {
            background-color: #4caf50;
            border-color: #4caf50;
            width: 100%;
            padding: 0.8rem;
            font-size: 1.1rem;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background-color: #45a049;
            border-color: #45a049;
            transform: translateY(-2px);
        }

        .register-link {
            display: block;
            text-align: center;
            color: #2e7d32;
            text-decoration: none;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .register-link:hover {
            background-color: rgba(200, 230, 201, 0.5);
            border-radius: 5px;
        }

        .form-control {
            padding: 0.8rem;
            font-size: 1rem;
            border-radius: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #2e7d32;
            margin-bottom: 0.5rem;
        }

        .icono-superior-izquierda {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            color: #fff;
            font-size: 28px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: rgba(76, 175, 80, 0.7);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icono-superior-izquierda:hover {
            background-color: #4caf50;
            transform: scale(1.1) rotate(-10deg);
        }

        .login-title {
            color: #2e7d32;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 2rem;
        }

        .input-group-text {
            cursor: pointer;
            background-color: transparent;
            border-left: none;
        }

        .input-group-text:hover {
            color: #4caf50;
        }

        .football {
            position: absolute;
            width: 60px;
            height: 60px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23ffffff' d='M177.1 228.6L207.9 320h96.5l29.62-91.38L256 172.1L177.1 228.6zM255.1 0C114.6 0 .0001 114.6 .0001 256S114.6 512 256 512s255.1-114.6 255.1-255.1S397.4 0 255.1 0zM416.6 360.9l-85.4-1.297l-25.15 81.59C290.1 445.5 273.4 448 256 448s-34.09-2.523-50.09-6.859L180.8 359.6l-85.4 1.297c-18.12-27.66-29.15-60.27-30.88-95.31L134.3 216.4L106.6 135.6c21.16-26.21 49.09-46.61 81.06-58.84L256 128l68.29-51.22c31.98 12.23 59.9 32.64 81.06 58.84L377.7 216.4l69.78 49.1C445.8 300.6 434.8 333.2 416.6 360.9z'/%3E%3C/svg%3E");
            background-size: contain;
            animation: bounce 10s infinite linear;
        }

        @keyframes bounce {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(100vw, 50vh); }
            50% { transform: translate(50vw, 100vh); }
            75% { transform: translate(-50vw, 50vh); }
        }
    </style>
</head>
<body>
    <div class="background-container"></div>
    <div class="football"></div>

    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Iniciar Sesión</h2>
            <form action="login.php" method="POST">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su usuario" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                        <span class="input-group-text" id="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary login-button">Ingresar</button>
            </form><br>
            <a href="resgistro.php" class="register-link">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>

    <a href="../../inicio.php" class="icono-superior-izquierda">
        <i class="bi bi-arrow-left-circle-fill"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var icon = document.getElementById('toggle-password').getElementsByTagName('i')[0];
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>