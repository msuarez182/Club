<?php
session_start();
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';
isLogin();
include("../includes/authModal.php");
// Verificar login
// Ahora incluir el header
// Configuración de paginación
$articulos_por_pagina = 9; // 3x3 = 9 artículos por página
$pagina_actual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_actual - 1) * $articulos_por_pagina;
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

// Filtrar solo las subcategorías válidas
$selected_subcategories = array_filter($selected_subcategories, function($subcat) use ($valid_subcategories) {
    return in_array($subcat, $valid_subcategories);
});

// Construir consulta base con filtros
$base_sql = "SELECT 
    id_articulo,
    id_categoriaarticulo,
    Ruta,
    Titulo,
    ImagenPrincipal,
    PalabrasClave,
    Resumen,
    Contenido1,
    Contenido2,
    Contenido3,
    Oculto,
    CategoriaClub,
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
FROM articulo
WHERE CategoriaClub = 1";

// Aplicar filtros si existen
if (!empty($search_term)) {
    $base_sql .= " AND (Titulo LIKE '%" . mysqli_real_escape_string($dbMedicable, $search_term) . "%' 
                OR Resumen LIKE '%" . mysqli_real_escape_string($dbMedicable, $search_term) . "%')";
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

// Obtener el total de artículos filtrados
$total_articulos_sql = "SELECT COUNT(*) as total FROM ($base_sql) AS total_query";
$total_articulos_result = mysqli_query($dbMedicable, $total_articulos_sql);
$total_articulos = mysqli_fetch_assoc($total_articulos_result)['total'];
$total_paginas = ceil($total_articulos / $articulos_por_pagina);

// Obtener artículos para la página actual con filtros
$articles_sql = $base_sql . " ORDER BY id_articulo DESC LIMIT $articulos_por_pagina OFFSET $offset";
$articles_result = mysqli_query($dbMedicable, $articles_sql);
$articles = mysqli_fetch_all($articles_result, MYSQLI_ASSOC);

// Obtener 4 artículos aleatorios para la sección superior (sin filtros para mantener variedad)
$random_sql = "SELECT * FROM articulo WHERE CategoriaClub = 1 ORDER BY RAND() LIMIT 4";
$random_result = mysqli_query($dbMedicable, $random_sql);
$random_articles = mysqli_fetch_all($random_result, MYSQLI_ASSOC);

// Subcategorías predefinidas
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
    <title>Club Medicable - Artículos sobre Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body class="bg-light">

  <!-- Contenido principal -->
  <main class="container py-4">
    <!-- Sección superior -->
<div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <div id="randomArticlesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-3 shadow-sm" style="height: 300px;"> <!-- Altura fija para el carrusel -->
                    <?php
                    $first = true;
                    foreach($random_articles as $article) {
                        $imagen_url = "https://www.medicable.com.mx/assets/img/Articulos/".$article['id_articulo']."/".$article['ImagenPrincipal'];
                        $headers = @get_headers($imagen_url);
                        if(!$headers || strpos($headers[0], '404')) {
                            $imagen_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
                        }
                        echo '<div class="carousel-item'.($first ? ' active' : '').' h-100">
                                <a href="articulo.php?type=articulos&id='.$article['id_articulo'].'" class="img-link h-100 d-block">
                                    <img src="'.$imagen_url.'" 
                                         class="d-block mx-auto h-100 w-auto"
                                         style="max-width: 100%; object-fit: contain;"
                                         alt="'.$article['Titulo'].'">
                                </a>
                              </div>';
                        $first = false;
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#randomArticlesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#randomArticlesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <div class="carousel-indicators position-static mt-3">
                    <?php
                    for($i = 0; $i < count($random_articles); $i++) {
                        echo '<button type="button" data-bs-target="#randomArticlesCarousel" 
                                data-bs-slide-to="'.$i.'"'.($i === 0 ? ' class="active" aria-current="true"' : '').'
                                aria-label="Slide '.($i+1).'"></button>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white bg-opacity-75 p-4 rounded-3 shadow-sm">
                <h1 class="h3 text-primary fw-bold border-bottom pb-2">Artículos</h1>
                <p class="mt-3 mb-4">
                    La diabetes es una condición que requiere información clara y confiable. En esta sección encontrarás artículos sencillos y útiles para comprenderla, controlarla y mejorar tu calidad de vida día a día.
                </p>
            </div>
        </div>
    </div>
</div>

    <!-- Filtros y artículos -->
    <div class="row">
      <!-- Filtros -->
      <div class="col-lg-3 mb-4">
        <div class="bg-white p-3 rounded-3 shadow-sm border">
          <h2 class="h5 text-primary fw-bold mb-3 pb-2 border-bottom">Filtrar artículos</h2>
          
          <form id="filter-form" method="get" action="">
            <div class="mb-3 position-relative">
              <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
              <input type="text" id="search-input" name="search" class="form-control ps-5 rounded-pill" 
                     placeholder="Buscar artículos..." value="<?= htmlspecialchars($search_term) ?>">
            </div>
            
            <div class="mb-3">
              <h3 class="h6 fw-bold mb-2 text-muted">Categorías</h3>
              <?php
              foreach($subcategories as $subcat) {
                $checked = in_array($subcat, $selected_subcategories) ? 'checked' : '';
                $id = str_replace([' ', '?', '¿'], '_', strtolower($subcat));
                echo '<div class="form-check">
                        <input class="form-check-input subcategory-filter" type="checkbox" 
                               id="subcat_'.$id.'" 
                               name="subcategories[]"
                               value="'.$subcat.'" '.$checked.'>
                        <label class="form-check-label" for="subcat_'.$id.'">'.$subcat.'</label>
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
      
      <!-- Artículos -->
      <div class="col-lg-9">
        <?php if (!empty($search_term) || !empty($selected_subcategories)): ?>
        <div class="alert alert-info mb-4">
          Mostrando <?= $total_articulos ?> resultados 
          <?= !empty($search_term) ? 'para "<strong>'.htmlspecialchars($search_term).'</strong>"' : '' ?>
          <?= !empty($selected_subcategories) ? 'en los tipos: '.implode(', ', $selected_subcategories) : '' ?>
          <a href="?" class="float-end text-decoration-none">Limpiar filtros</a>
        </div>
        <?php endif; ?>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          <?php
          if (count($articles) > 0) {
            foreach($articles as $article) {
              $imagen_url = "https://www.medicable.com.mx/assets/img/Articulos/".$article['id_articulo']."/".$article['ImagenPrincipal'];
              $headers = @get_headers($imagen_url);
              if(!$headers || strpos($headers[0], '404')) {
                $imagen_url = "https://www.medicable.com.mx/assets/img/logo-blanco.png";
              }
              
              echo '<div class="col">
                      <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <a href="articulo.php?type=articulos&id='.$article['id_articulo'].'" class="img-link">
                          <div class="img-container">
                            <img src="'.$imagen_url.'" 
                                 class="card-img-top"
                                 alt="'.$article['Titulo'].'">
                          </div>
                        </a>
                      </div>
                    </div>';
            }
          } else {
            echo '<div class="col-12" id="no-results">
                    <div class="bg-white rounded-3 p-5 text-center shadow-sm">
                      <i class="fas fa-search fa-3x text-muted mb-3"></i>
                      <h3 class="h5 text-muted">No se encontraron artículos</h3>
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
        <nav aria-label="Paginación de artículos" class="mt-5">
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
                      <a class="page-link text-primary" href="'.$base_url.'&pagina=1">1</a>
                    </li>';
              if ($inicio > 2) {
                echo '<li class="page-item disabled">
                        <span class="page-link">...</span>
                      </li>';
              }
            }
            
            // Mostrar páginas en el rango
            for ($i = $inicio; $i <= $fin; $i++) {
              echo '<li class="page-item '.($i == $pagina_actual ? 'active' : '').'">
                      <a class="page-link '.($i == $pagina_actual ? 'bg-primary border-primary' : 'text-primary').'" 
                         href="'.$base_url.'&pagina='.$i.'">'.$i.'</a>
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
                      <a class="page-link text-primary" href="'.$base_url.'&pagina='.$total_paginas.'">'.$total_paginas.'</a>
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
<?php

?>