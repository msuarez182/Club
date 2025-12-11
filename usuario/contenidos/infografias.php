<?php
session_start();
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';
// Verificar login
isLogin();
// Ahora incluir el header
include("../includes/authModal.php");
// Configuración de paginación
$infografias_por_pagina = 9; // 3x3 = 9 infografías por página
$pagina_actual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_actual - 1) * $infografias_por_pagina;

// Obtener parámetros de filtro
$search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
$selected_subcategories = isset($_GET['subcategories']) ? $_GET['subcategories'] : [];

// Asegurarse de que sea array
if (!is_array($selected_subcategories)) {
  $selected_subcategories = [];
}

// Mapeo de clasificacionClub a subcategorías
$clasificacion_map = [
  1 => 'Tengo diabetes, ¿y ahora qué?',
  2 => 'Recomendaciones y cuidados',
  3 => 'Prevención de complicaciones',
  4 => 'Resistencia a la insulina',
  5 => 'Diabetes gestacional',
  6 => 'Diabetes tipo 1',
  7 => 'Te puede interesar'
];

$valid_subcategories = array_values($clasificacion_map);

$selected_subcategories = array_filter($selected_subcategories, function ($subcat) use ($valid_subcategories) {
  return in_array($subcat, $valid_subcategories);
});

// Construir consulta base con filtros
$base_sql = "SELECT 
    id_infografia,
    id_categoriainfografia,
    Titulo,
    Imagen2,
    copy,
    clasificacionClub,
    CASE 
        WHEN clasificacionClub = 1 THEN 'Tengo diabetes, ¿y ahora qué?'
        WHEN clasificacionClub = 2 THEN 'Recomendaciones y cuidados'
        WHEN clasificacionClub = 3 THEN 'Prevención de complicaciones'
        WHEN clasificacionClub = 4 THEN 'Resistencia a la insulina'
        WHEN clasificacionClub = 5 THEN 'Diabetes gestacional'
        WHEN clasificacionClub = 6 THEN 'Diabetes tipo 1'
        WHEN clasificacionClub = 7 THEN 'Te puede interesar'
        ELSE NULL
    END AS SubCategoria
FROM infografia
WHERE CategoriaClub = 1";

// Aplicar filtros si existen
if (!empty($search_term)) {
  $base_sql .= " AND (Titulo LIKE '%" . mysqli_real_escape_string($dbMedicable, $search_term) . "%' 
              OR copy LIKE '%" . mysqli_real_escape_string($dbMedicable, $search_term) . "%')";
}

// Filtrar por subcategorías si existen
if (!empty($selected_subcategories)) {
  $subconditions = [];
  foreach ($selected_subcategories as $subcat) {
    // Buscar el número de clasificación correspondiente
    $clasificacion_num = array_search($subcat, $clasificacion_map);
    if ($clasificacion_num !== false) {
      $subconditions[] = "clasificacionClub = " . intval($clasificacion_num);
    }
  }
  if (!empty($subconditions)) {
    $base_sql .= " AND (" . implode(" OR ", $subconditions) . ")";
  }
}

// Obtener el total de infografías filtradas
$total_infografias_sql = "SELECT COUNT(*) as total FROM ($base_sql) AS total_query";
$total_infografias_result = mysqli_query($dbMedicable, $total_infografias_sql);
$total_infografias = mysqli_fetch_assoc($total_infografias_result)['total'];
$total_paginas = ceil($total_infografias / $infografias_por_pagina);

// Obtener infografías para la página actual con filtros
$infografias_sql = $base_sql . " ORDER BY id_infografia DESC LIMIT $infografias_por_pagina OFFSET $offset";
$infografias_result = mysqli_query($dbMedicable, $infografias_sql);
$infografias = mysqli_fetch_all($infografias_result, MYSQLI_ASSOC);

// Obtener 4 infografías aleatorias para la sección superior (sin filtros para mantener variedad)
$random_sql = "SELECT id_infografia, Titulo, Imagen2, copy FROM infografia WHERE CategoriaClub = 1 ORDER BY RAND() LIMIT 4";
$random_result = mysqli_query($dbMedicable, $random_sql);
$random_infografias = mysqli_fetch_all($random_result, MYSQLI_ASSOC);

// Subcategorías predefinidas (nuevas categorías)
$subcategories = [
  'Tengo diabetes, ¿y ahora qué?',
  'Recomendaciones y cuidados',
  'Prevención de complicaciones',
  'Resistencia a la insulina',
  'Diabetes gestacional',
  'Diabetes tipo 1',
  'Te puede interesar'
];

// Construir URL base para paginación manteniendo los filtros
$url_params = [];
if (!empty($search_term)) $url_params['search'] = $search_term;
if (!empty($selected_subcategories)) $url_params['subcategories'] = $selected_subcategories;
$base_url = '?' . http_build_query($url_params);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club Medicable - Infografías sobre diabetes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @font-face {
      font-family: 'Acumin Variable Concept';
      src: url('path-to-your-font/AcuminVariableConcept.woff2') format('woff2'),
        url('path-to-your-font/AcuminVariableConcept.woff') format('woff');
      font-weight: normal;
      font-style: normal;
      font-display: swap;
    }

    body {
      font-family: 'Acumin Variable Concept', sans-serif;
    }

    .text-primary {
      color: #4ca8d1 !important;
    }

    .bg-primary {
      background-color: #4ca8d1 !important;
    }

    .border-primary {
      border-color: #4ca8d1 !important;
    }

    .btn-primary {
      background-color: #4ca8d1;
      border-color: #4ca8d1;
    }

    .btn-primary:hover {
      background-color: #3a8cb7;
      border-color: #3a8cb7;
    }

    .text-secondary {
      color: #eb9022 !important;
    }

    .bg-secondary {
      background-color: #eb9022 !important;
    }

    .border-secondary {
      border-color: #eb9022 !important;
    }

    .btn-secondary {
      background-color: #eb9022;
      border-color: #eb9022;
    }

    .btn-secondary:hover {
      background-color: #d17e1a;
      border-color: #d17e1a;
    }

    .badge.bg-primary {
      background-color: #4ca8d1 !important;
    }

    .page-item.active .page-link {
      background-color: #4ca8d1;
      border-color: #4ca8d1;
    }

    .page-link.text-primary {
      color: #4ca8d1 !important;
    }

    .hover-shadow:hover {
      box-shadow: 0 0.5rem 1rem rgba(76, 168, 209, 0.15) !important;
      transform: translateY(-2px);
      transition: all 0.3s ease;
    }

    .card {
      transition: all 0.3s ease;
    }

    .card:hover {
      border-color: rgba(76, 168, 209, 0.3);
    }

    /* Estilos para imágenes */
    .img-container {
      position: relative;
      width: 100%;
      padding-top: 100%;
      /* Relación 1:1 (cuadrado) */
      overflow: hidden;
    }

    .img-container img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
      /* Muestra la imagen completa sin recortar */
      background-color: #f8f9fa;
      /* Fondo para áreas vacías si la imagen no es cuadrada */
    }

    /* Estilos para el filtrado */
    #no-results {
      display: none;
      text-align: center;
      padding: 20px;
      color: #6c757d;
    }

    /* Estilo para checkboxes seleccionados */
    .category-filter:checked+label {
      font-weight: bold;
      color: #4ca8d1;
    }

    /* Estilo para enlaces de imágenes */
    .img-link {
      display: block;
      transition: opacity 0.2s;
    }

    .img-link:hover {
      opacity: 0.9;
    }

    /* Asegurar que las imágenes sean puntero al pasar el mouse */
    .clickable-img {
      cursor: pointer;
    }

    /* Estilos para el texto copy */
    .copy-text {
      font-size: 0.9rem;
      color: #6c757d;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .card-body {
      padding: 1rem;
    }
  </style>
</head>

<body class="bg-light">
  <!-- Contenido principal -->
  <main class="container py-4">
    <!-- Sección superior -->
    <div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm">
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <div id="infografiasCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded-3 shadow-sm" style="height: 350px;"> <!-- Altura ajustada para infografías -->
              <?php
              $first = true;
              foreach ($random_infografias as $infografia) {
                $imagen_url = "https://www.medicable.com.mx/assets/img/Infografias/" . $infografia['id_infografia'] . "/" . $infografia['Imagen2'];
                $headers = @get_headers($imagen_url);
                if (!$headers || strpos($headers[0], '404')) {
                  $imagen_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
                }
                echo '<div class="carousel-item' . ($first ? ' active' : '') . ' h-100">
                                <a href="infografia.php?id=' . $infografia['id_infografia'] . '" class="img-link h-100 d-flex align-items-center justify-content-center">
                                    <img src="' . $imagen_url . '" 
                                         class="d-block mx-auto mh-100 mw-100"
                                         style="object-fit: contain; max-height: 100%; max-width: 100%;"
                                         alt="' . $infografia['Titulo'] . '">
                                </a>
                              </div>';
                $first = false;
              }
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#infografiasCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
              <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#infografiasCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
              <span class="visually-hidden">Siguiente</span>
            </button>
            <div class="carousel-indicators position-static mt-3">
              <?php
              for ($i = 0; $i < count($random_infografias); $i++) {
                echo '<button type="button" data-bs-target="#infografiasCarousel" 
                                data-bs-slide-to="' . $i . '"' . ($i === 0 ? ' class="active" aria-current="true"' : '') . '
                                aria-label="Infografía ' . ($i + 1) . '"></button>';
              }
              ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bg-white bg-opacity-75 p-4 rounded-3 shadow-sm">
            <h1 class="h3 text-primary fw-bold border-bottom pb-2">Infografías</h1>
            <p class="mt-3 mb-4">
              Descubre información práctica y visual sobre la diabetes. Estas infografías te ayudarán a entender mejor la enfermedad, sus cuidados y las acciones clave para prevenir complicaciones de forma clara y sencilla.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Filtros e infografías -->
    <div class="row">
      <!-- Filtros -->
      <div class="col-lg-3 mb-4">
        <div class="bg-white p-3 rounded-3 shadow-sm border">
          <h2 class="h5 text-primary fw-bold mb-3 pb-2 border-bottom">Filtrar infografías</h2>

          <form id="filter-form" method="get" action="">
            <div class="mb-3 position-relative">
              <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
              <input type="text" id="search-input" name="search" class="form-control ps-5 rounded-pill"
                placeholder="Buscar infografías..." value="<?= htmlspecialchars($search_term) ?>">
            </div>

            <div class="mb-3">
              <h3 class="h6 fw-bold mb-2 text-muted">Categorías</h3>
              <?php
              foreach ($subcategories as $subcat) {
                $checked = in_array($subcat, $selected_subcategories) ? 'checked' : '';
                $id = str_replace([' ', '?', '¿'], '_', strtolower($subcat));
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
              <i class="fas fa-filter me-2"></i>Aplicar filtros
            </button>

            <button type="button" id="reset-filters" class="btn btn-outline-secondary w-100">
              <i class="fas fa-undo me-2"></i>Restablecer filtros
            </button>
          </form>
        </div>
      </div>

      <!-- Infografías -->
      <div class="col-lg-9">
        <?php if (!empty($search_term) || !empty($selected_subcategories)): ?>
          <div class="alert alert-info mb-4">
            Mostrando <?= $total_infografias ?> resultados
            <?= !empty($search_term) ? 'para "<strong>' . htmlspecialchars($search_term) . '</strong>"' : '' ?>
            <?= !empty($selected_subcategories) ? 'en las categorías: ' . implode(', ', $selected_subcategories) : '' ?>
            <a href="?" class="float-end text-decoration-none">Limpiar filtros</a>
          </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php
          if (count($infografias) > 0) {
            foreach ($infografias as $infografia) {
              $imagen_url = "https://www.medicable.com.mx/assets/img/Infografias/" . $infografia['id_infografia'] . "/" . $infografia['Imagen2'];
              $headers = @get_headers($imagen_url);
              if (!$headers || strpos($headers[0], '404')) {
                $imagen_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
              }

              echo '<div class="col">
                      <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <a href="infografia.php?id=' . $infografia['id_infografia'] . '" class="img-link">
                          <img src="' . $imagen_url . '" 
                               class="card-img-top clickable-img"
                               alt="' . $infografia['Titulo'] . '"
                               style="height: 250px; object-fit: contain;">
                        </a>
                        <div class="card-body">
                          <p class="copy-text">' . htmlspecialchars($infografia['copy']) . '</p>
                        </div>
                      </div>
                    </div>';
            }
          } else {
            echo '<div class="col-12" id="no-results">
                    <div class="bg-white rounded-3 p-5 text-center shadow-sm">
                      <i class="fas fa-search fa-3x text-muted mb-3"></i>
                      <h3 class="h5 text-muted">No se encontraron infografías</h3>
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
          <nav aria-label="Paginación de infografías" class="mt-5">
            <ul class="pagination justify-content-center">
              <li class="page-item <?= $pagina_actual == 1 ? 'disabled' : '' ?>">
                <a class="page-link text-primary" href="<?= $base_url ?>&pagina=<?= $pagina_actual - 1 ?>" tabindex="-1">
                  <i class="fas fa-chevron-left"></i>
                </a>
              </li>

              <?php
              // Mostrar números de página
              $paginas_a_mostrar = 3; // Número de páginas a mostrar alrededor de la actual
              $inicio = max(1, $pagina_actual - $paginas_a_mostrar);
              $fin = min($total_paginas, $pagina_actual + $paginas_a_mostrar);

              // Mostrar primera página si no está en el rango
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

              // Mostrar páginas en el rango
              for ($i = $inicio; $i <= $fin; $i++) {
                echo '<li class="page-item ' . ($i == $pagina_actual ? 'active' : '') . '">
                      <a class="page-link ' . ($i == $pagina_actual ? 'bg-primary border-primary' : 'text-primary') . '" 
                         href="' . $base_url . '&pagina=' . $i . '">' . $i . '</a>
                    </li>';
              }

              // Mostrar última página si no está en el rango
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
  </main>
  <?php include("../includes/banner.php"); ?>
  <?php include("../includes/footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
