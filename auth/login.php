<?php
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../includes/database/dbClub.php';
$alertasBackend = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioLoguead = false;
    //recibimos el JSON del registro
    $json = file_get_contents('php://input');
    $post = json_decode($json, true);

    //Asignación de variables
    $correo = $dbClub->real_escape_string($post['correo']);
    $password = $post['password'];

    if (!$correo) {
        $alertasBackend['error'][] = 'El campo correo no puede estar vacío';
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $alertasBackend['error'][] = 'Ingresa un correo válido';
    }
    if (!$password) {
        $alertasBackend['error'][] = 'Ingresa el password';
    }

    if (empty($alertas)) {
        //buscar si esta registrado el usuario
        $query = "SELECT * FROM usuarios WHERE correo='$correo'";
        $resultado = $dbClub->query($query);
        $usuario = $resultado->fetch_assoc();
        //si existe el usuario en nuestra bd iniciamos sesión
        if ($usuario) {
            $resultado = password_verify($password, $usuario['password']);

            if (!$resultado) {
                $alertasBackend['error'][] = 'Error, password incorrecto';
            } else {
                //si existe usuario y la password es correcta, creamos la sesión
                session_start();
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['apellidoPaterno'] = $usuario['apellido_paterno'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
                $_SESSION['login'] = true;
                if ($_SESSION['login']) {
                    $respuesta = [
                        'usuarioLogueado' => true,
                        'alertasBackend' => $alertasBackend
                    ];
                    echo json_encode($respuesta);
                    exit;
                }
            }
        } else {
            $alertasBackend['error'][] = 'Error, el correo electrónico no esta registrado';
        };
    }
    $respuesta = [
        'usuarioLogueado' => false,
        'alertasBackend' => $alertasBackend
    ];
    echo json_encode($respuesta);
    exit;
}
