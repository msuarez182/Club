<?php

use App\Email;


require_once __DIR__ . '../../../includes/database/dbClub.php';
require_once __DIR__ . '../../../includes/funciones.php';

//backend de confirme asistecia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $svId = filter_var($_POST['svId'], FILTER_VALIDATE_INT);
    $usuarioId = filter_var($_POST['usuarioId'], FILTER_VALIDATE_INT);

    //insertar en la bd la sv y el usuario registrado
    $sql = "INSERT INTO sv_usuario (usuarioId, svId) VALUES ($usuarioId,$svId)";
    $resultado = $dbClub->query($sql);



    //traemos la información del evento y el usuario
    $query = "SELECT usuarios.nombre, usuarios.correo sv.fecha, sv.titulo 
        FROM usuarios 
        INNER JOIN sv_usuario AS pivote
        ON usuarios.id = pivote.usuarioId
        INNER JOIN sv 
        ON sv.id = pivote.svId
        WHERE pivote.usuarioId=$usuarioId AND pivote.svId=$svId";

    $resultado = $dbClub->query($query);
    $informacion = $resultado->fetch_array(MYSQLI_ASSOC);

    $nombre=$informacion['nombre'];
    $fecha=$informacion['fecha'];
    $titulo=$informacion['titulo'];
    $correo=$informacion['correo'];
    

    if ($resultado) {
        $respuesta = [
            'confirmado' => true,
            'nombre'=>$nombre,
            'fecha'=>$fecha,
            'titulo'=>$titulo
        ];
        echo json_encode($respuesta);

        $enviarConfirmacion= new Email($correo, $nombre, null);
        $enviarConfirmacion->enviarConfirmacion($correo, $nombre, $titulo, $fecha);

    }
}
