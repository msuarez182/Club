<?php
require_once __DIR__ . '/../vendor/autoload.php';

function dd($debuguear):string
{
    echo "<pre>";
    var_dump($debuguear);
    echo "</pre>";
    die;
}

//sanitiza para mostrar datos de forma segura al usuario
function sanitizar($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}


function base_path(): string
{
    //https://medicable.com.mx/club/
    return "localhost/club/";
}

//verifica si esta logueado
function isLogin():void
{

    if (!isset($_SESSION['login'])) {
        header('Location:/club/usuario/inicio.php');
        exit;
    }
}



// Función para convertir URL de YouTube a formato embebido
function embeberYoutubeUrl($url) {
    // Patrones para detectar diferentes formatos de YouTube
    $patterns = [
        '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
        '/youtu\.be\/([a-zA-Z0-9_-]+)/',
        '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/'
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return "https://www.youtube.com/embed/" . $matches[1];
        }
    }
    
    // Si no coincide con ningún patrón, devolver el original
    return $url;
}