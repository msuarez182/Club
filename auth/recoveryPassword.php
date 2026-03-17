<?php

use App\Email;


require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../includes/database/dbClub.php';
$alertasBackend = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recoveryPassword = false;
    //recibimos el JSON del registro
    $json = file_get_contents('php://input');
    $email = json_decode($json, true);
    //sanitizamos
    $correo = $dbClub->real_escape_string($email);
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

    //validaciones del backend 
    if (!$correo) {
        $alertasBackend['error'][] = 'El campo correo no puede estar vacío';
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $alertasBackend['error'][] = 'Ingresa un correo válido';
    }

    // Si no hay errores, procedemos
    if (empty($alertasBackend)) {
        // Buscamos al usuario
        $query = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $resultado = $dbClub->query($query);
        $usuario = $resultado->fetch_assoc();
        if ($usuario) {
            $nombre = $usuario['nombre']; // Traemos el nombre de la bd
            // Si existe el usuario entonces creamos el token
            $token = md5(rand());
            //actualizamos la bd con ese token
            $query = "UPDATE usuarios SET token ='{$token}' WHERE correo='{$correo}' ";
            $resultado = $dbClub->query($query);
            //enviamos el correo de recuperacion por email
            $email = new Email($correo, $token, $nombre);
            $email->enviarCorreo();
            $alertasBackend['exito'][] = 'Exito. Se enviaron las instrucciones a tu correo registrado!';
            $respuesta = [
                'recoveryPassword' => true,
                'alertasBackend' => $alertasBackend
            ];
            echo json_encode($respuesta);
            exit;
        } else {
            $alertasBackend['error'][] = 'Este correo no está registrado';
        }
    }
    $respuesta = [
        'recoveryPassword' => false,
        'alertasBackend' => $alertasBackend
    ];
    echo json_encode($respuesta);
    exit;
}
