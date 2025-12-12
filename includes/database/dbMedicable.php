<?php


// Establecer conexi��n con la base de datos

use App\ActiveRecord;

function dbMedicable()
{
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "medicable_nversion";


    $dbMedicable = new Mysqli($servidor, $usuario, $clave, $baseDeDatos);
    $dbMedicable->set_charset("utf8");
    if (!$dbMedicable) {
        return die("Conexi��n fallida: " . mysqli_connect_error());
    }
    return $dbMedicable;
}
$dbMedicable=dbMedicable();

