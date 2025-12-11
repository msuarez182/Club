<?php
require_once __DIR__ . '../../auth/logout.php';
require_once __DIR__ . '../../includes/funciones.php';

$_SESSION = [];
//elimina la cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

if (empty($_SESSION)) {
    header('Location: /club/usuario/inicio.php');
}
