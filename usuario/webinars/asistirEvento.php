<?php
require_once __DIR__ . '../../../includes/database/dbClub.php';
require_once __DIR__ . '../../../includes/funciones.php';

//backend de confirme asistecia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $svId = filter_var($_POST['svId'], FILTER_VALIDATE_INT);
    $usuarioId = filter_var($_POST['usuarioId'], FILTER_VALIDATE_INT);

    //insertar en la bd la sv y el usuario registrado
    $sql = "INSERT INTO sv_usuario (usuarioId, svId) VALUES ($usuarioId,$svId)";
    $resultado = $dbClub->query($sql);
    if ($resultado) {
        $respuesta = [
            'confirmado' => true
        ];
       echo json_encode($respuesta);
    }
}
