<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../funciones.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->safeLoad();


function dbClub()
{
    $dbClub = new Mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
    $dbClub->set_charset("utf8");
    return $dbClub;
}

$dbClub = dbClub();
