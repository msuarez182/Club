<?php 
require_once __DIR__.'../../../includes/database/dbClub.php';
require_once __DIR__.'../../../includes/funciones.php';

$query="SELECT * FROM sv WHERE status = '1'";
$resultado=$dbClub->query($query);
if($resultado->num_rows){
    $respuesta=$resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($respuesta);//sirve las sv en formato JSON

}else{
    $alertasBackend['error'][]='No existen sesiones virtuales';
    $respuesta=[
        'alertasBackend'=>$alertasBackend
    ];
    echo json_encode($alertasBackend);
}

