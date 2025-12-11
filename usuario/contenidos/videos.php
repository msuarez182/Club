<?php
session_start();
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';
// Verificar login
isLogin();
// Ahora incluir el header
include("../includes/authModal.php");
// Configuración de paginación
$videos_por_pagina = 9;
$pagina_actual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_actual - 1) * $videos_por_pagina;

// Obtener parámetros de filtro
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
$selected_subcategories = isset($_GET['subcategories']) ? $_GET['subcategories'] : [];

// Validar subcategorías
$valid_subcategories = ['Tengo diabetes, ¿y ahora qué?', 'Recomendaciones y cuidados', 'Prevención de complicaciones', 'Resistencia a la insulina', 'Diabetes gestacional', 'Diabetes tipo 1', 'También te puede interesar'];
$selected_subcategories = array_filter($selected_subcategories, function ($subcat) use ($valid_subcategories) {
  return in_array($subcat, $valid_subcategories);
});

// Consulta base con filtros
$base_sql = "SELECT 
    id_video,
    Titulo,
    Video,
    Descripcion,
    CASE 
        WHEN Titulo LIKE '%Tengo diabetes, ¿y ahora qué?%' OR Descripcion LIKE '%Tengo diabetes, ¿y ahora qué?%' THEN 'Tengo diabetes, ¿y ahora qué?'
        WHEN Titulo LIKE '%Recomendaciones y cuidados%' OR Descripcion LIKE '%Recomendaciones y cuidados%' THEN 'Recomendaciones y cuidados'
        WHEN Titulo LIKE '%Prevención de complicaciones%' OR Descripcion LIKE '%Prevención de complicaciones%' THEN 'Prevención de complicaciones'
        WHEN Titulo LIKE '%Resistencia a la insulina%' OR Descripcion LIKE '%Resistencia a la insulina%' THEN 'Resistencia a la insulina'
        WHEN Titulo LIKE '%Diabetes gestacional%' OR Descripcion LIKE '%Diabetes gestacional%' THEN 'Diabetes gestacional'
        WHEN Titulo LIKE '%Diabetes tipo 1%' OR Descripcion LIKE '%Diabetes tipo 1%' THEN 'Diabetes tipo 1'
        WHEN Titulo LIKE '%También te puede interesar%' OR Descripcion LIKE '%También te puede interesar%' THEN 'También te puede interesar'
        ELSE 'Diabetes'
    END AS SubCategoria
FROM video
WHERE CategoriaClub = 1";

if (!empty($search_term)) {
  $base_sql .= " AND (Titulo LIKE '%" . mysqli_real_escape_string($dbMedicable, $search_term) . "%' 
                OR Descripcion LIKE '%" . mysqli_real_escape_string($dbMedicable, $search_term) . "%')";
}

if (!empty($selected_subcategories)) {
  $subconditions = [];
  foreach ($selected_subcategories as $subcat) {
    $escaped_subcat = mysqli_real_escape_string($dbMedicable, $subcat);
    $subconditions[] = "(Titulo LIKE '%$escaped_subcat%' OR Descripcion LIKE '%$escaped_subcat%')";
  }
  $base_sql .= " AND (" . implode(" OR ", $subconditions) . ")";
}

// Obtener videos
$total_videos_sql = "SELECT COUNT(*) as total FROM ($base_sql) AS total_query";
$total_videos_result = mysqli_query($dbMedicable, $total_videos_sql);
$total_videos = mysqli_fetch_assoc($total_videos_result)['total'];
$total_paginas = ceil($total_videos / $videos_por_pagina);

$videos_sql = $base_sql . " ORDER BY id_video DESC LIMIT $videos_por_pagina OFFSET $offset";
$videos_result = mysqli_query($dbMedicable, $videos_sql);
$videos = mysqli_fetch_all($videos_result, MYSQLI_ASSOC);

// Videos aleatorios
$random_sql = "SELECT * FROM video WHERE CategoriaClub = 1 ORDER BY RAND() LIMIT 4";
$random_result = mysqli_query($dbMedicable, $random_sql);
$random_videos = mysqli_fetch_all($random_result, MYSQLI_ASSOC);

// Videos recomendados (también te puede interesar)
$recommended_sql = "SELECT * FROM video WHERE CategoriaClub = 1 AND (Titulo LIKE '%También te puede interesar%' OR Descripcion LIKE '%También te puede interesar%') ORDER BY RAND() LIMIT 3";
$recommended_result = mysqli_query($dbMedicable, $recommended_sql);
$recommended_videos = mysqli_fetch_all($recommended_result, MYSQLI_ASSOC);

$subcategories = ['Tengo diabetes, ¿y ahora qué?', 'Recomendaciones y cuidados', 'Prevención de complicaciones', 'Resistencia a la insulina', 'Diabetes gestacional', 'Diabetes tipo 1', 'También te puede interesar'];
$base_url = '?' . http_build_query(array_filter([
  'search' => $search_term,
  'subcategories' => $selected_subcategories
]));
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Medicable - Videos </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/videos.css">

</head>

<body class="bg-light">


  <!-- Contenido principal -->
  <main class="container py-4">
    <!-- Sección superior -->
    <div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <div id="videosCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-3 shadow-sm" style="height: 350px;">
              <?php
              $first = true;
              foreach ($random_videos as $video) {
                $video_url = $video['Video'];
                $is_youtube = preg_match('/(youtube\.com|youtu\.be)/', $video_url);
                $thumbnail_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";

                if ($is_youtube) {
                  if (
                    preg_match('/youtube\.com.*(\?v=|\/embed\/)(.{11})/', $video_url, $matches) ||
                    preg_match('/youtu\.be\/(.{11})/', $video_url, $matches)
                  ) {
                    $youtube_id = $matches[2] ?? $matches[1];
                    $thumbnail_url = "https://img.youtube.com/vi/$youtube_id/maxresdefault.jpg";
                  }
                }

                echo '<div class="carousel-item' . ($first ? ' active' : '') . ' h-100">
                                <div class="video-thumbnail-container h-100 position-relative">
                                    <img src="' . $thumbnail_url . '" 
                                         class="d-block w-100 h-100 object-fit-cover"
                                         alt="' . $video['Titulo'] . '">
                                    <div class="play-icon position-absolute top-50 start-50 translate-middle" 
                                         data-bs-toggle="modal" data-bs-target="#videoModal" 
                                         data-video-src="' . ($is_youtube ? 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1' : $video_url) . '">
                                        <i class="fas fa-play-circle fs-1 text-white bg-primary bg-opacity-75 rounded-circle"></i>
                                    </div>
                                </div>
                              </div>';
                $first = false;
              }
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#videosCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
              <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#videosCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
              <span class="visually-hidden">Siguiente</span>
            </button>
            <div class="carousel-indicators position-static mt-3">
              <?php
              for ($i = 0; $i < count($random_videos); $i++) {
                echo '<button type="button" data-bs-target="#videosCarousel" 
                                data-bs-slide-to="' . $i . '"' . ($i === 0 ? ' class="active" aria-current="true"' : '') . '
                                aria-label="Video ' . ($i + 1) . '"></button>';
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bg-white bg-opacity-75 p-4 rounded-3 shadow-sm">
            <h1 class="h3 text-primary fw-bold border-bottom pb-2">Videos</h1>
            <p class="mt-3 mb-4">
              Aprende de la mano de médicos y expertos en diabetes. En estos videos, los especialistas explican de manera sencilla temas importantes para tu salud, control y bienestar.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Filtros y videos -->
    <div class="row">
      <!-- Filtros -->
      <div class="col-lg-3 mb-4">
        <div class="bg-white p-3 rounded-3 shadow-sm border">
          <h2 class="h5 text-primary fw-bold mb-3 pb-2 border-bottom">Filtrar Videos</h2>

          <form id="filter-form" method="get" action="">
            <div class="mb-3 position-relative">
              <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
              <input type="text" id="search-input" name="search" class="form-control ps-5 rounded-pill"
                placeholder="Buscar videos..." value="<?= htmlspecialchars($search_term) ?>">
            </div>

            <div class="mb-3">
              <h3 class="h6 text-uppercase fw-bold mb-2 text-muted">Tipos</h3>
              <?php
              foreach ($subcategories as $subcat) {
                $checked = in_array($subcat, $selected_subcategories) ? 'checked' : '';
                $id = str_replace([' ', '¿', '?', 'á', 'é', 'í', 'ó', 'ú'], ['_', '', '', 'a', 'e', 'i', 'o', 'u'], strtolower($subcat));
                echo '<div class="form-check">
                        <input class="form-check-input subcategory-filter" type="checkbox" 
                               id="subcat_' . $id . '" 
                               name="subcategories[]"
                               value="' . $subcat . '" ' . $checked . '>
                        <label class="form-check-label" for="subcat_' . $id . '">' . $subcat . '</label>
                      </div>';
              }
              ?>
            </div>

            <input type="hidden" name="pagina" value="1" id="pagina-hidden">

            <button type="submit" class="btn btn-primary w-100 mb-2">
              <i class="fas fa-filter me-2"></i>Aplicar Filtros
            </button>

            <button type="button" id="reset-filters" class="btn btn-outline-secondary w-100">
              <i class="fas fa-undo me-2"></i>Restablecer Filtros
            </button>
          </form>
        </div>
      </div>

      <!-- Videos -->
      <div class="col-lg-9">
        <?php if (!empty($search_term) || !empty($selected_subcategories)): ?>
          <div class="alert alert-info mb-4">
            Mostrando <?= $total_videos ?> resultados
            <?= !empty($search_term) ? 'para "<strong>' . htmlspecialchars($search_term) . '</strong>"' : '' ?>
            <?= !empty($selected_subcategories) ? 'en los tipos: ' . implode(', ', $selected_subcategories) : '' ?>
            <a href="?" class="float-end text-decoration-none">Limpiar filtros</a>
          </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php
          if (count($videos) > 0) {
            foreach ($videos as $video) {
              $video_url = $video['Video'];
              $is_youtube = preg_match('/(youtube\.com|youtu\.be)/', $video_url);
              $thumbnail_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
              $youtube_id = '';

              if ($is_youtube) {
                if (
                  preg_match('/youtube\.com.*(\?v=|\/embed\/)(.{11})/', $video_url, $matches) ||
                  preg_match('/youtu\.be\/(.{11})/', $video_url, $matches)
                ) {
                  $youtube_id = $matches[2] ?? $matches[1];
                  $thumbnail_url = "https://img.youtube.com/vi/$youtube_id/mqdefault.jpg";
                }
              }

              echo '<div class="col">
                      <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="video-thumbnail">
                          <img src="' . $thumbnail_url . '" class="clickable-img" alt="' . $video['Titulo'] . '">
                          <div class="play-icon" data-bs-toggle="modal" data-bs-target="#videoModal" 
                               data-video-src="' . ($is_youtube ? 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1' : $video_url) . '">
                            <i class="fas fa-play-circle"></i>
                          </div>
                        </div>
                        <div class="card-body">
                          <p class="card-text text-muted small">' . $video['Descripcion'] . '</p>
                        </div>
                      </div>
                    </div>';
            }
          } else {
            echo '<div class="col-12" id="no-results">
                    <div class="bg-white rounded-3 p-5 text-center shadow-sm">
                      <i class="fas fa-search fa-3x text-muted mb-3"></i>
                      <h3 class="h5 text-muted">No se encontraron videos</h3>
                      <p class="text-muted">Intenta con otros términos de búsqueda o ajusta los filtros</p>
                      <a href="?" class="btn btn-primary mt-2">
                        <i class="fas fa-undo me-2"></i>Restablecer filtros
                      </a>
                    </div>
                  </div>';
          }
          ?>
        </div>

        <!-- Paginación -->
        <?php if ($total_paginas > 1): ?>
          <nav aria-label="Paginación de videos" class="mt-5">
            <ul class="pagination justify-content-center">
              <li class="page-item <?= $pagina_actual == 1 ? 'disabled' : '' ?>">
                <a class="page-link text-primary" href="<?= $base_url ?>&pagina=<?= $pagina_actual - 1 ?>" tabindex="-1">
                  <i class="fas fa-chevron-left"></i>
                </a>
              </li>

              <?php
              // Mostrar números de página
              $paginas_a_mostrar = 3;
              $inicio = max(1, $pagina_actual - $paginas_a_mostrar);
              $fin = min($total_paginas, $pagina_actual + $paginas_a_mostrar);

              if ($inicio > 1) {
                echo '<li class="page-item">
                      <a class="page-link text-primary" href="' . $base_url . '&pagina=1">1</a>
                    </li>';
                if ($inicio > 2) {
                  echo '<li class="page-item disabled">
                        <span class="page-link">...</span>
                      </li>';
                }
              }

              for ($i = $inicio; $i <= $fin; $i++) {
                echo '<li class="page-item ' . ($i == $pagina_actual ? 'active' : '') . '">
                      <a class="page-link ' . ($i == $pagina_actual ? 'bg-primary border-primary' : 'text-primary') . '" 
                         href="' . $base_url . '&pagina=' . $i . '">' . $i . '</a>
                    </li>';
              }

              if ($fin < $total_paginas) {
                if ($fin < $total_paginas - 1) {
                  echo '<li class="page-item disabled">
                        <span class="page-link">...</span>
                      </li>';
                }
                echo '<li class="page-item">
                      <a class="page-link text-primary" href="' . $base_url . '&pagina=' . $total_paginas . '">' . $total_paginas . '</a>
                    </li>';
              }
              ?>

              <li class="page-item <?= $pagina_actual == $total_paginas ? 'disabled' : '' ?>">
                <a class="page-link text-primary" href="<?= $base_url ?>&pagina=<?= $pagina_actual + 1 ?>">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        <?php endif; ?>
      </div>
    </div>

    <!-- Sección "También te puede interesar" -->
    <?php if (count($recommended_videos) > 0): ?>
      <div class="recommended-section mt-5">
        <h2 class="h4 text-primary fw-bold mb-4 text-center">También te puede interesar</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php
          foreach ($recommended_videos as $video) {
            $video_url = $video['Video'];
            $is_youtube = preg_match('/(youtube\.com|youtu\.be)/', $video_url);
            $thumbnail_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
            $youtube_id = '';

            if ($is_youtube) {
              if (
                preg_match('/youtube\.com.*(\?v=|\/embed\/)(.{11})/', $video_url, $matches) ||
                preg_match('/youtu\.be\/(.{11})/', $video_url, $matches)
              ) {
                $youtube_id = $matches[2] ?? $matches[1];
                $thumbnail_url = "https://img.youtube.com/vi/$youtube_id/mqdefault.jpg";
              }
            }

            echo '<div class="col">
                        <div class="card recommended-card border-0 shadow-sm">
                            <div class="recommended-thumbnail">
                                <img src="' . $thumbnail_url . '" class="clickable-img" alt="' . $video['Titulo'] . '">
                                <div class="play-icon" data-bs-toggle="modal" data-bs-target="#videoModal" 
                                     data-video-src="' . ($is_youtube ? 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1' : $video_url) . '">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title h6">' . $video['Titulo'] . '</h5>
                                <p class="card-text text-muted small">' . substr($video['Descripcion'], 0, 100) . '...</p>
                            </div>
                        </div>
                    </div>';
          }
          ?>
        </div>
      </div>
    <?php endif; ?>
  </main>

 
 
 
 
  <!-- Modal para videos -->
  <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="videoModalLabel">Reproduciendo video</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" id="cerrar-video"></button>
        </div>
        <div class="modal-body">
          <div class="ratio ratio-16x9">
            <iframe id="videoFrame" src="" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("../includes/banner.php"); ?>
  <?php include("../includes/footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/contenidos/videos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Restablecer filtros
    document.getElementById('reset-filters').addEventListener('click', function() {
      window.location.href = window.location.pathname;
    });

    // Actualizar el campo oculto de página cuando se aplican filtros
    document.getElementById('filter-form').addEventListener('submit', function() {
      document.getElementById('pagina-hidden').value = 1;
    });
  });
</script>


</body>




</html>