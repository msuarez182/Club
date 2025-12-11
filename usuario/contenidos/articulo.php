<?php
// Incluir conexión a la base de datos
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';
include("../includes/authModal.php");


// Validar y sanitizar el ID del artículo
$id_articulo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_articulo || $id_articulo <= 0) {
    header("HTTP/1.0 404 Not Found");
    include('404.php');
    exit();
}

$sql = "SELECT 
            id_articulo, 
            Titulo, 
            Resumen, 
            Contenido1, 
            Contenido2, 
            Contenido3,
            ImagenPrincipal,
            id_categoriaarticulo AS categoria_id
        FROM 
            articulo
        WHERE 
            id_articulo = ? 
            AND CategoriaClub = 1
        LIMIT 1";

$stmt = mysqli_prepare($dbMedicable, $sql);

if (!$stmt) {
    die('Error en la preparación de la consulta: ' . mysqli_error($dbMedicable));
}

mysqli_stmt_bind_param($stmt, "i", $id_articulo);
mysqli_stmt_execute($stmt);

// Solución alternativa para cuando mysqli_stmt_get_result() no está disponible
mysqli_stmt_bind_result(
    $stmt,
    $id_articulo,
    $Titulo,
    $Resumen,
    $Contenido1,
    $Contenido2,
    $Contenido3,
    $ImagenPrincipal,
    $categoria_id
);

if (!mysqli_stmt_fetch($stmt)) {
    header("HTTP/1.0 404 Not Found");
    include('404.php');
    exit();
}

// Crear array con los datos del artículo
$articulo = [
    'id_articulo' => $id_articulo,
    'Titulo' => $Titulo,
    'Resumen' => $Resumen,
    'Contenido1' => $Contenido1,
    'Contenido2' => $Contenido2,
    'Contenido3' => $Contenido3,
    'ImagenPrincipal' => $ImagenPrincipal,
    'categoria_id' => $categoria_id
];

// Configurar título de la página
$page_title = htmlspecialchars($articulo['Titulo']) . " | Club Medicable";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/img/ClubMedicableIco.ico" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/articulo.css">

</head>

<body>


    <div class="container py-4">
        <div class="main-container">
            <article>
                <!-- Encabezado del artículo -->
                <div class="article-header">

                    <h1 class="article-title"><?= htmlspecialchars($articulo['Titulo']) ?></h1>

                    <?php if (!empty($articulo['Resumen'])): ?>
                        <p class="article-excerpt"><?= htmlspecialchars($articulo['Resumen']) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Imagen principal -->
                <?php
                $imagen_url = "https://www.medicable.com.mx/assets/img/Articulos/{$articulo['id_articulo']}/{$articulo['ImagenPrincipal']}";
                $headers = @get_headers($imagen_url);

                if ($headers && strpos($headers[0], '200')) {
                    echo '<div class="text-center">
                            <img src="' . htmlspecialchars($imagen_url) . '" 
                                 class="article-featured-image" 
                                 alt="' . htmlspecialchars($articulo['Titulo']) . '">
                          </div>';
                }
                ?>

                <!-- Contenido del artículo -->
                <div class="article-content">
                    <?php if (!empty($articulo['Contenido1'])): ?>
                        <div class="content-section">
                            <?= $articulo['Contenido1'] ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    if ($usuarioLogueado) { //si inicio sesión leé los 2 parrafos más
                        if (!empty($articulo['Contenido2'])): ?>
                            <div class="content-section">
                                <?= $articulo['Contenido2'] ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($articulo['Contenido3'])): ?>
                            <div class="content-section">
                                <?= $articulo['Contenido3'] ?>
                            </div>
                        <?php endif;
                    } else { //si no, muestra un boton de continuar leyendo ?>
                        <div class="continuar__leyendo">
                            <img src="../assets/img/continuar-leyendo.png" class="img-continuar" alt="imagen-blur">
                            <div class="continuar__leyendo-boton">
                                <button class="btn btn-primary-custom mt-2 restringido" id="loginButtonMenu">CONTINUAR LEYENDO</button>
                            </div>

                        </div>
                    <?php } ?>

                </div>

                <!-- Pie del artículo -->
                <div class="article-footer">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                        <a href="articulos.php" class="btn btn-outline-primary mb-4 mb-lg-0">
                            <i class="fas fa-arrow-left me-2"></i> Volver a artículos
                        </a>

                        <div class="d-flex align-items-center">
                            <span class="text-muted me-3 d-none d-lg-block">Compartir:</span>
                            <div class="d-flex gap-3">
                                <a href="#" class="share-btn facebook-btn" data-network="facebook" title="Compartir en Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="share-btn x-btn" data-network="twitter" title="Compartir en X">
                                    <i class="fab fa-x-twitter"></i>
                                </a>
                                <a href="#" class="share-btn linkedin-btn" data-network="linkedin" title="Compartir en LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="share-btn whatsapp-btn" data-network="whatsapp" title="Compartir por WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <?php include("../includes/banner.php"); ?>

    <!-- Script para compartir en redes sociales -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareBtns = document.querySelectorAll('.share-btn');
            const currentUrl = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.title);

            shareBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const network = this.getAttribute('data-network');
                    let url = '';

                    switch (network) {
                        case 'facebook':
                            url = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;
                            break;
                        case 'twitter':
                            url = `https://twitter.com/intent/tweet?url=${currentUrl}&text=${title}`;
                            break;
                        case 'linkedin':
                            url = `https://www.linkedin.com/shareArticle?mini=true&url=${currentUrl}&title=${title}`;
                            break;
                        case 'whatsapp':
                            url = `https://wa.me/?text=${title} ${currentUrl}`;
                            break;
                    }

                    if (url) {
                        window.open(url, '_blank', 'width=600,height=400');
                    }
                });
            });
        });
    </script>
    <?php
    // Incluir pie de página
    include("../includes/footer.php");

    // Cerrar conexión
    mysqli_stmt_close($stmt);
    mysqli_close($dbMedicable);
    ?>

    <!-- Scripts de Bootstrap y Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="../assets/js/auth/restringirContenido.js"></script>
</body>

</html>