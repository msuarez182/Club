<?php

use App\ActiveRecord;
require_once __DIR__ . '/../../vendor/autoload.php';


function dbClub(){
    $dbClub= new Mysqli('localhost','root','','club');
    $dbClub->set_charset("utf8");
    return $dbClub;
}

$dbClub=dbClub();
