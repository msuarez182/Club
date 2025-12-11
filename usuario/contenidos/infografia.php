<?php
include("../includes/authModal.php");
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';

// Validar y sanitizar el ID de la infografía
$id_infografia = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_infografia || $id_infografia <= 0) {
    header("HTTP/1.0 404 Not Found");
    include('404.php');
    exit();
}

// Consulta preparada para obtener la infografía (ajustada a los campos reales)
$sql = "SELECT 
            id_infografia, 
            Titulo, 
            Imagen1, 
            Imagen2,
            id_categoriainfografia
        FROM 
            infografia
        WHERE 
            id_infografia = ? 
            AND CategoriaClub = 1
        LIMIT 1";

$stmt = mysqli_prepare($dbMedicable, $sql);

if (!$stmt) {
    die('Error en la preparación de la consulta: ' . mysqli_error($dbMedicable));
}

mysqli_stmt_bind_param($stmt, "i", $id_infografia);
mysqli_stmt_execute($stmt);

// Solución alternativa para cuando mysqli_stmt_get_result() no está disponible
mysqli_stmt_bind_result(
    $stmt,
    $id_infografia,
    $Titulo,
    $Imagen1,
    $Imagen2,
    $id_categoriainfografia
);

if (!mysqli_stmt_fetch($stmt)) {
    header("HTTP/1.0 404 Not Found");
    include('404.php');
    exit();
}

// Crear array con los datos de la infografía
$infografia = [
    'id_infografia' => $id_infografia,
    'Titulo' => $Titulo,
    'Imagen1' => $Imagen1,
    'Imagen2' => $Imagen2,
    'id_categoriainfografia' => $id_categoriainfografia
];

// Configurar título de la página
$page_title = sanitizar($infografia['Titulo']) . " | Club Medicable";

// Determinar qué imagen está disponible para descarga
$imagen_descarga = null;
$imagen_url = "https://www.medicable.com.mx/assets/img/Infografias/{$infografia['id_infografia']}/{$infografia['Imagen1']}";
$headers = @get_headers($imagen_url);

if ($headers && strpos($headers[0], '200')) {
    $imagen_descarga = $imagen_url;
} else {
    $imagen_url = "https://www.medicable.com.mx/assets/img/Infografias/{$infografia['id_infografia']}/{$infografia['Imagen2']}";
    $headers = @get_headers($imagen_url);

    if ($headers && strpos($headers[0], '200')) {
        $imagen_descarga = $imagen_url;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/infografia.css">

</head>

<body>


    <div class="container py-5">
        <div class="main-container">
            <article>
                <!-- Encabezado de la infografía -->
                <div class="infografia-header">
                    <?php if (!empty($infografia['id_categoriainfografia'])): ?>
                        <div class="text-center">
                            <span class="category-badge">Categoría <?= sanitizar($infografia['id_categoriainfografia']) ?></span>
                        </div>
                    <?php endif; ?>

                    <h1 class="infografia-title"><?= sanitizar($infografia['Titulo']) ?></h1>
                </div>

                <!-- Imagen principal -->
                <?php if ($imagen_descarga): ?>

                    <img src="<?= sanitizar($imagen_descarga) ?>"
                        class="infografia-featured-image <?php echo !$usuarioLogueado ? 'blur-3' : '' ?>"
                        alt="<?= sanitizar($infografia['Titulo']) ?>"
                        id="infografia-imagen">

                <?php endif; ?>

                <!-- Pie de la infografía -->
                <div class="infografia-footer">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                        <?php if ($usuarioLogueado): ?>
                            <a href="infografias.php" class="btn btn-outline-primary mb-4 mb-lg-0">
                                <i class="fas fa-arrow-left me-2"></i> Volver a infografías
                            </a>

                            <div class="d-flex align-items-center">
                                <?php if ($imagen_descarga): ?>
                                    <a href="<?= sanitizar($imagen_descarga) ?>"
                                        class="download-btn me-3"
                                        download="<?= sanitizar($infografia['Titulo']) ?>.jpg"
                                        title="Descargar infografía"
                                        target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
                                <?php endif; ?>

                                <span class="text-muted me-3 d-none d-lg-block">Compartir:</span>
                                <div class="d-flex gap-3">
                                    <a href="#" class="share-btn" data-network="facebook" title="Compartir en Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="share-btn" data-network="twitter" title="Compartir en Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="share-btn" data-network="linkedin" title="Compartir en LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="share-btn" data-network="whatsapp" title="Compartir por WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="continuar__leyendo">
                                <button class="btn btn-primary-custom restringido">Inicia sesión para visualizar el contenido</button>
                            </div>
                        <?php endif ?>
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
    ?>

    <!-- Scripts de Bootstrap y Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <script src="../assets/js/auth/restringirContenido.js"></script>
    <script src="../assets/js/contenidos/clickDerecho.js"></script>


</body>

</html>