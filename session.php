<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 86400,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        if (basename($_SERVER['PHP_SELF']) != '../registro.php') {
            header('Location: ../registro.php?error=Debes iniciar sesión');
            exit();
        }
    }
}

function obtenerUsuarioId() {
    return $_SESSION['user_id'] ?? null;
}




?>