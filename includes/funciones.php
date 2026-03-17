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
    return "http://localhost/club/";
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




//funcion para slug urls amigables

function slug($texto) {
    // 1. Convertir a minúsculas
    $texto = strtolower($texto);
    
    // 2. Transliterar (eliminar acentos, ñ, etc.)
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
    
    // 3. Reemplazar caracteres no alfanuméricos (excepto guiones) por guiones
    // Se usa preg_replace para quitar todo lo que no sea letra, número o guion
    $texto = preg_replace('/[^a-z0-9-]+/', '-', $texto);
    
    // 4. Eliminar guiones repetidos
    $texto = preg_replace('/-+/', '-', $texto);
    
    // 5. Eliminar guiones al inicio y al final
    $texto = trim($texto, '-');
    
    return $texto;
}


