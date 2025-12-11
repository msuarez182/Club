<?php

require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../includes/database/dbClub.php';
$alertasBackend = [];
$nombre_documento = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registrado = false;

    //Asignación de variables
    $id = $_POST['id'] ?? null;
    $nombre = $dbClub->real_escape_string($_POST['nombre'] ?? '');
    $apellidoPaterno = $dbClub->real_escape_string($_POST['apellidoPaterno'] ?? '');
    $apellidoMaterno = $dbClub->real_escape_string($_POST['apellidoMaterno'] ?? '');
    $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
    $tipoUsuario = $dbClub->real_escape_string($_POST['tipoUsuario'] ?? '');
    $nivelEstudios = $dbClub->real_escape_string($_POST['nivelEstudios'] ?? '');
    $cedula = $dbClub->real_escape_string($_POST['cedula'] ?? '');
    $documento = $_FILES['documento'] ?? '';
    $codigoPostal = $dbClub->real_escape_string($_POST['codigoPostal'] ?? '');
    $correo = $dbClub->real_escape_string($_POST['correo'] ?? '');
    $password1 = $dbClub->real_escape_string($_POST['password1'] ?? '');
    $passwordConfirm = $dbClub->real_escape_string($_POST['passwordConfirm'] ?? '');

    //validaciónes del backend
    if (!$nombre) {
        $alertasBackend['error'][] = 'El campo nombre no puede estar vacío';
    }
    if (!$apellidoPaterno) {
        $alertasBackend['error'][] = 'El campo apellido paterno no puede estar vacío';
    }
    if (!$tipoUsuario) {
        $alertasBackend['error'][] = 'Debes seleccionar un tipo de usuario';
    }
    if (!$correo) {
        $alertasBackend['error'][] = 'El campo correo no puede estar vacío';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $alertasBackend['error'][] = 'Ingresa un correo válido';
    }
    if (!$fechaNacimiento) {
        $alertasBackend['error'][] = 'El campo fecha de nacimiento no puede estar vacío';
    }
    if (!$codigoPostal) {
        $alertasBackend['error'][] = 'El campo código postal no puede estar vacío';
    }
    if (!empty($documento)) {
        if ($documento['size'] > 5 * 1024 * 1024) {
            $alertasBackend['error'][] = 'Archivo es demasiado grande (máximo 5MB)';
        }
    }

    if (!$password1) {
        $alertasBackend['error'][] = 'Ingresa un password';
    } elseif (strlen($password1) < 6) {
        $alertasBackend['error'][] = 'El password debe tener al menos 6 caracteres';
    }
    if ($password1 !== $passwordConfirm) {
        $alertasBackend['error'][] = 'Las contraseñas no coinciden';
    }

    if (!empty($documento)) {
        if ($documento['type'] !== 'application/pdf') {
            $alertasBackend['error'][] = 'Error, selecciona un archivo PDF';
        }
    }


    // Si no hay errores, proceder con el usuarios
    if (empty($alertasBackend)) {
        $query = "SELECT correo FROM usuarios WHERE correo ='$correo'";
        $respuesta = $dbClub->query($query);
        $usuario = $respuesta->num_rows;

        //Si no existe el usuario lo registramos
        if (!$usuario) {
            //crear documento
            $storage = '../usuario/assets/storage/';

            //si el documento no esta vacío
            if (!empty($documento)) {
                //si no existe directorio
                if (!is_dir($storage)) {
                    mkdir($storage, 0777);
                }
                //creando el documento
                $nombre_documento = md5(uniqid(rand(), true));
                //moviendo el documento con su nuevo nombre
                move_uploaded_file($documento['tmp_name'], $storage . $nombre_documento . '.pdf');
            }
            //hash password
            $password_hash = password_hash($passwordConfirm, PASSWORD_BCRYPT);
            //insertando registro
            $query = ("INSERT INTO usuarios (nombre, apellido_paterno,apellido_materno, tipo_usuario,nivel_estudios,cedula,documento, correo, fecha_nacimiento, password, codigo_postal, token) VALUES ('$nombre', '$apellidoPaterno','$apellidoMaterno','$tipoUsuario','$nivelEstudios','$cedula','$nombre_documento','$correo','$fechaNacimiento','$password_hash','$codigoPostal','')");
            //realizar consulta
            $resultado = $dbClub->query($query);
            if ($resultado) {
                $respuesta = [
                    "registrado" => true,
                    "alertasBackend" => $alertasBackend
                ];
                echo json_encode($respuesta);
                return;
            } else {
                $alertasBackend['error'][] = 'Error al registrar el usuario';
            }
        } else {
            $alertasBackend['error'][] = 'Error, este correo ya esta registrado';
        }
    }
    $respuesta = [
        "registrado" => false,
        "alertasBackend" => $alertasBackend
    ];


    echo json_encode($respuesta);
    exit;
}
