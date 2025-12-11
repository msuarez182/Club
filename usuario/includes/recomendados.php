<?php
// Incluir la conexión a la base de datos
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';

// Consulta para obtener un artículo aleatorio
$sql_articulo_aleatorio = "SELECT 
    id_articulo,
    Titulo,
    ImagenPrincipal,
    Resumen,
    Ruta
FROM articulo 
WHERE CategoriaClub = 1 
ORDER BY RAND() 
LIMIT 1";

$result_articulo = mysqli_query($dbMedicable, $sql_articulo_aleatorio);
$articulo_aleatorio = mysqli_fetch_assoc($result_articulo);

// Construir la URL de la imagen para artículo
if ($articulo_aleatorio) {
    $imagen_articulo_url = "https://www.medicable.com.mx/assets/img/Articulos/" . $articulo_aleatorio['id_articulo'] . "/" . $articulo_aleatorio['ImagenPrincipal'];

    // Verificar si la imagen existe
    $headers = @get_headers($imagen_articulo_url);
    if (!$headers || strpos($headers[0], '404')) {
        $imagen_articulo_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
    }
}

// Consulta para obtener una infografía aleatoria
$sql_infografia_aleatoria = "SELECT 
    id_infografia,
    Titulo,
    Imagen2
FROM infografia 
WHERE CategoriaClub = 1 
ORDER BY RAND() 
LIMIT 1";

$result_infografia = mysqli_query($dbMedicable, $sql_infografia_aleatoria);
$infografia_aleatoria = mysqli_fetch_assoc($result_infografia);

// Construir la URL de la imagen para infografía
if ($infografia_aleatoria) {
    $imagen_infografia_url = "https://www.medicable.com.mx/assets/img/Infografias/" . $infografia_aleatoria['id_infografia'] . "/" . $infografia_aleatoria['Imagen2'];

    // Verificar si la imagen existe
    $headers = @get_headers($imagen_infografia_url);
    if (!$headers || strpos($headers[0], '404')) {
        $imagen_infografia_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
    }
}

// Consulta para obtener un video aleatorio
$sql_video_aleatorio = "SELECT 
    id_video,
    Titulo,
    Video,
    Descripcion
FROM video 
WHERE CategoriaClub = 1 
ORDER BY RAND() 
LIMIT 1";

$result_video = mysqli_query($dbMedicable, $sql_video_aleatorio);
$video_aleatorio = mysqli_fetch_assoc($result_video);

// Construir la URL del thumbnail para video
if ($video_aleatorio) {
    $video_url = $video_aleatorio['Video'];
    $is_youtube = preg_match('/(youtube\.com|youtu\.be)/', $video_url);
    $imagen_video_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";

    if ($is_youtube) {
        if (
            preg_match('/youtube\.com.*(\?v=|\/embed\/)(.{11})/', $video_url, $matches) ||
            preg_match('/youtu\.be\/(.{11})/', $video_url, $matches)
        ) {
            $youtube_id = $matches[2] ?? $matches[1];
            $imagen_video_url = "https://img.youtube.com/vi/$youtube_id/mqdefault.jpg";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/club/usuario/assets/css/recomendados.css">
</head>

<body>

    <!-- Cards de Recomendaciones -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Recomendados para ti</h2>
        <div class="row">
            <!-- Card para Artículo (con artículo aleatorio) -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header articulo-recomendado text-white">
                        <h5 class="card-title mb-0">Artículo Recomendado</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($articulo_aleatorio): ?>

                            <div class="text-center mb-2">
                                <img src="<?php echo $imagen_articulo_url; ?>"
                                    class="img-fluid rounded"
                                    alt="<?php echo sanitizar($articulo_aleatorio['Titulo']); ?>"
                                    style="max-height: 150px; object-fit: cover;">
                            </div>
                            <p class="card-text"><?php echo sanitizar(substr($articulo_aleatorio['Resumen'], 0, 100) . '...'); ?></p>
                        <?php else: ?>
                            <p class="card-text">No hay artículos disponibles en este momento.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?php if ($articulo_aleatorio): ?>
                            <a href="articulo.php?id=<?php echo $infografia_aleatoria['id_infografia'];?>" class="btn btn-primary-custom ">Leer artículo</a>
                        <?php else: ?>
                            <a href="#" class="btn btn-primary-custom disabled">Leer artículo</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Card para Video (con video aleatorio) -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header video-recomendado text-white">
                        <h5 class="card-title mb-0 ">Video Recomendado</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($video_aleatorio): ?>
                            <div class="text-center mb-2 position-relative">
                                <img src="<?php echo $imagen_video_url; ?>"
                                    class="img-fluid rounded"
                                    alt="<?php echo sanitizar($video_aleatorio['Titulo']); ?>"
                                    style="max-height: 150px; object-fit: cover;">
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class="fas fa-play-circle fa-3x text-white" style="opacity: 0.8;"></i>
                                </div>
                            </div>
                            <p class="card-text"><?php echo sanitizar(substr($video_aleatorio['Descripcion'], 0, 100) . '...'); ?></p>
                        <?php else: ?>
                            <p class="card-text">No hay videos disponibles en este momento.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?php if ($video_aleatorio): ?>
                            <a href="#" class="btn btn-primary-custom " data-bs-toggle="modal" data-bs-target="#videoModal"
                                data-video-src="<?php echo $is_youtube ? 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1' : $video_url; ?>">
                                Ver video
                            </a>
                        <?php else: ?>
                            <a href="#" class="btn btn-outline-danger disabled">Ver video</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Card para Infografía (con infografía aleatoria) -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header infografia-recomendado text-white">
                        <h5 class="card-title mb-0 ">Infografía Recomendada</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($infografia_aleatoria): ?>
                            <div class="text-center mb-2">
                                <img src="<?php echo $imagen_infografia_url; ?>"
                                    class="img-fluid rounded"
                                    alt="<?php echo sanitizar($infografia_aleatoria['Titulo']); ?>"
                                    style="max-height: 150px; object-fit: contain;">
                            </div>
                        <?php else: ?>
                            <p class="card-text">No hay infografías disponibles en este momento.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?php if ($infografia_aleatoria): ?>
                            <a href="infografia.php?id=<?php echo $infografia_aleatoria['id_infografia']; ?>" class="btn btn-primary-custom ">Ver infografía</a>
                        <?php else: ?>
                            <a href="#" class="btn btn-primary-custom  disabled">Ver infografía</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal para videos (solo se incluye si no existe ya en la página) -->
    <?php if (!isset($video_modal_included)): ?>
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel">Reproduciendo video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoFrame" src="" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $video_modal_included = true; ?>
    <?php endif; ?>

    <!-- Script para el modal de video (solo se incluye si no existe ya en la página) -->
    <?php if (!isset($video_script_included)): ?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar modal para videos
        var videoModal = document.getElementById('videoModal');
        if (videoModal) {
            videoModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var videoSrc = button.getAttribute('data-video-src');
                document.getElementById('videoFrame').src = videoSrc;
            });

            videoModal.addEventListener('hide.bs.modal', function() {
                document.getElementById('videoFrame').src = '';
            });
        }
    });
</script>
<?php $video_script_included = true; ?>
<?php endif; ?>