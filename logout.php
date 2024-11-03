<?php

// Eliminar todas las variables de sesión
$_SESSION = [];

// Si deseas eliminar la cookie de sesión, también puedes hacerlo
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio o a otra página
header("Location: http://localhost/AMACSS_SOFT41C-GP3/index.php"); // Cambia esta ruta a donde quieras redirigir
exit();
?>
