<?php


// Establecer conexi��n con la base de datos

use App\ActiveRecord;

function dbMedicable()
{

    

// $servidor = "localhost";
// $usuario = "root";
// $clave = "maiki";
// $baseDeDatos = "medicable_nversion";


    $dbMedicable = new Mysqli($_ENV['DBM_HOST'],$_ENV['DBM_USER'],$_ENV['DBM_PASS'],$_ENV['DBM_NAME']);
    $dbMedicable->set_charset("utf8");
    if (!$dbMedicable) {
        return die("Conexi��n fallida: " . mysqli_connect_error());
    }
    return $dbMedicable;
}
$dbMedicable=dbMedicable();

