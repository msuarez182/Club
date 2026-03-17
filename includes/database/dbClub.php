<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../funciones.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->safeLoad();


function dbClub()
{
    $dbClub = new Mysqli($_ENV['DBC_HOST'], $_ENV['DBC_USER'], $_ENV['DBC_PASS'], $_ENV['DBC_NAME']);
    $dbClub->set_charset("utf8");
    return $dbClub;
}

$dbClub = dbClub();
