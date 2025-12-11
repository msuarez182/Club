<?php
session_start();
require_once('../../includes/database/dbClub.php');
require_once('../../includes/funciones.php');
isLogin();
//consultamos a la base de datos
$limit = 6;
$sql = "SELECT * FROM sv WHERE status=1 limit $limit";
$resultado = $dbClub->query($sql);
$sesiones = $resultado->fetch_all(MYSQLI_ASSOC);




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Medicable - Sesiones Virtuales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Fuente Acumin (reemplaza con tu enlace real) -->
    <link rel="stylesheet" href="https://use.typekit.net/xyz.css">
    <link rel="stylesheet" href="<?php echo base_path() ?>usuario/assets/css/sesionesVirtuales.css">

</head>

<body>
    <?php include("../includes/authModal.php"); ?>

    <!-- Sección Hero -->
    <section class="hero-section my-3">
        <div class="container">
            <div class="row align-items-center" id="sv">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Sesiones Virtuales Club Medicable</h1>
                    <p class="lead mb-4">Accede a conocimiento especializado desde la comodidad de tu hogar. Nuestros expertos te guiarán en tu camino hacia el bienestar integral.</p>
                    <div class="d-flex flex-wrap gap-2 mt-4 mb-4">
                        <span class="date-badge"><i class="fas fa-check-circle me-2"></i>Certificados</span>
                        <span class="date-badge"><i class="fas fa-users me-2"></i>Interactivo</span>
                        <span class="date-badge"><i class="fas fa-heart me-2"></i>Enfoque humano</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="mainCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner rounded">
                            <?php

                            foreach ($sesiones as $sv) {
                               
                            ?>
                                <div class="carousel-item active">
                                    <img src="../assets/img/sv/<?php  echo $sv['id'] ."/". $sv['img_confirme'];  ?>" class="d-block w-100 carousel-img" alt="Alimentos saludables">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                                        <h5 class="fw-7"><?php echo $sv['titulo'] ?></h5>
                                        <p>Descubre recetas y planes de alimentación adecuados para ti.</p>
                                    </div>
                                </div>
                           


                                <?php } ?>

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Sección de beneficios -->
    <section class="container mb-2 py-5">
        <div class="row text-center">
            <div class="col-md-4 mb-4 info-box">
                <div class="info-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="mb-3">Horarios Flexibles</h3>
                <p class="px-3">Sesiones en diferentes horarios para que elijas el que mejor se adapte a tu rutina diaria.</p>
            </div>
            <div class="col-md-4 mb-4 info-box">
                <div class="info-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="mb-3">Expertos Certificados</h3>
                <p class="px-3">Profesionales de salud con amplia experiencia clínica y docente.</p>
            </div>
            <div class="col-md-4 mb-4 info-box">
                <div class="info-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="mb-3">Interacción Directa</h3>
                <p class="px-3">Resuelve tus dudas en tiempo real durante las sesiones en vivo.</p>
            </div>
        </div>
    </section>



    <main>
        <div class="container">
            <h2 class="content-title h2 fw-bold pb-2" style="color: #a1391e;"><span>Sesiones virtuales</span></h2>

            <div class="row g-4" id="sesiones-virtuales">

                <!-- Sección de beneficios -->


                <!-- Tarjeta 1 -->


            </div>
        </div>
    </main>



    <?php include("../includes/banner.php"); ?>
    <?php include("../includes/footer.php"); ?>
    <script type="module" src="../assets/js/sv/sv.js"></script>
</body>

</html>