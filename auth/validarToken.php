<?php
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../includes/database/dbClub.php';
$alertasBackend = [];
//leyendo el token de la url
$token = $_GET['token'] ?? '';
$token = sanitizar($token);
$recoveryPassword = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //recibimos el JSON del usuarios
    $json = file_get_contents('php://input');
    $post = json_decode($json, true);


    $password1 = $post['password1'];
    $password2 = $post['password2'];

    if ($password1 === '' || $password2 === '') {
        $alertasBackend['error'][] = 'Error! Todos los campos son obligatorios';
    }
    if ($password1 !== $password2) {
        $alertasBackend['error'][] = 'Error! los password no coinciden';
    }

    if (empty($alertasBackend)) {
        $password = password_hash($password2, PASSWORD_BCRYPT);
        //encriptamos el password
        $query = "UPDATE usuarios SET password ='$password' where token='$token'";
        $resultado = $dbClub->query($query);
        //seteamos el token a ''
        $query = "UPDATE usuarios SET token ='' where token='$token'";
        $resultado = $dbClub->query($query);
        if ($resultado) {
            $alertasBackend['exito'][] = 'Se guardo la nueva contraseña, vuelve a iniciar sesión';

            $respuesta = [
                "recoveryPassword" => true,
                "alertasBackend" => $alertasBackend
            ];

            echo json_encode($respuesta);
            exit;
        }
    }
    $respuesta = [
        "recoveryPassword" => false,
        "alertasBackend" => $alertasBackend
    ];

    echo json_encode($respuesta);
    exit;
}
