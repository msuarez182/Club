<?php include("includes/authModal.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio - Club Medicable</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/css/Inicio.css">
</head>

<body>



  <!-- Carrusel y Texto -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <!-- Texto a la izquierda -->
        <div class="col-lg-6 mb-4 mb-lg-0">
          <h2 class="display-4 fw-bold mb-3">Vivir con <span class="text-primary-custom">Diabetes</span></h2>
          <p class="lead mb-4">
            Encuentra toda la información y los recursos que necesitas para manejar tus niveles de glucosa y mejorar tu calidad de vida aquí, en Club Medicable.
          </p>
          <div class="mb-4">
            <ul class="list-unstyled">
              <li class="mb-2"><i class="fas fa-check text-primary-custom me-2"></i> Artículos especializados</li>
              <li class="mb-2"><i class="fas fa-check text-primary-custom me-2"></i> Infografías educativas</li>
              <li class="mb-2"><i class="fas fa-check text-primary-custom me-2"></i> Videos instructivos</li>
              <li class="mb-2"><i class="fas fa-check text-primary-custom me-2"></i> Comunidad de apoyo</li>
            </ul>
          </div>
          <a href="#" class="btn btn-primary-custom btn-lg px-4 restringido">Conoce más</a>
        </div>

        <!-- Carrusel a la derecha -->
        <div class="col-lg-6">
          <div id="mainCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="6" aria-label="Slide 7"></button>
              <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="7" aria-label="Slide 8"></button>


            </div>
            <div class="carousel-inner rounded">
              <div class="carousel-item active">
                <img src="assets/img/carrousel/1.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
              <div class="carousel-item">
                <img src="assets/img/carrousel/2.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
              <div class="carousel-item">
                <img src="assets/img/carrousel/3.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
              <div class="carousel-item">
                <img src="assets/img/carrousel/4.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
              <div class="carousel-item">
                <img src="assets/img/carrousel/5.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
              <div class="carousel-item">
                <img src="assets/img/carrousel/6.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
              <div class="carousel-item">
                <img src="assets/img/carrousel/7.jpg" class="d-block w-100 carousel-img" alt="Persona midiendo glucosa">
              </div>
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
  <?php include("includes/banner.php"); ?>
  <!-- Contenido Principal -->
  <main class="content-section">
    <div class="container">
      <h2 class="content-title h2 fw-bold pb-2" style="color: #a1391e;"><span>CONTENIDOS</span></h2>

      <div class="row g-4">
        <!-- Tarjeta 1 -->
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <img src="assets/img/Articulos.jpg" class="card-img-top" alt="Artículos sobre diabetes">
            <div class="card-body">
              <h3 class="card-title"><span class="text-primary-custom"><b>Artículos</b></span></h3>
              <p class="card-text">Información valiosa y actualizada, en lenguaje accesible y preciso que te permite entender la diabetes, y tomar las medidas para cuidarte y mejorar tu calidad de vida.</p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <a href="contenidos/articulos.php" class="btn btn-primary-custom restringido">Ver más</a>
            </div>
          </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <img src="assets/img/Infografias.jpg" class="card-img-top" alt="Infografías sobre diabetes">
            <div class="card-body">
              <h3 class="h3 fw-bold border-bottom pb-2 card-title" style="color: #4CA8D1;">Infografías</h3>
              <p class="card-text">Materiales gráficos, fáciles de entender y de compartir, que te ayuda a conocer los aspectos más importantes de la diabetes y los cuidados que te pueden ayudar en tu día a día.</p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <a href="contenidos/infografias.php" class="btn btn-primary-custom restringido">Ver más</a>
            </div>
          </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0">
            <img src="assets/img/Videos.jpg" class="card-img-top" alt="Videos sobre diabetes">
            <div class="card-body">
              <h3 class="h3 fw-bold border-bottom pb-2 card-title" style="color: #a1391e;">Videos</h3>
              <p class="card-text">Videos cortos en los que médicos expertos explican claramente la información que debes conocer acerca de la diabetes, para tomar decisiones informadas y adecuadas respecto a tu salud.</p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <a href="contenidos/videos.php" class="btn btn-primary-custom restringido">Ver más</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Sección de Video -->
  <section class="video-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="ratio ratio-16x9 video-container">
            <iframe src="https://www.youtube.com/embed/VIDEO_ID" title="Video sobre Club Medicable" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-lg-6 video-content">
          <h2 class="h3 fw-bold border-bottom pb-2 card-title" style="color: #a1391e;">¿Qué es Club Medicable?</h2>
          <p class="lead">
            Una comunidad dedicada a brindar apoyo, educación y recursos para personas que viven con diabetes.
          </p>
          <p>Nuestro objetivo es empoderarte con conocimiento y herramientas para que puedas manejar efectivamente tu condición y llevar una vida plena.</p>
          <a href="#" class="btn btn-primary-custom mt-3 restringido">Únete a nuestra comunidad</a>
        </div>
      </div>
    </div>
  </section>

  <?php include("includes/footer.php"); ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <!-- restringir el contenido -->
  <script src="/club/usuario/assets/js/auth/restringirContenido.js" type="module" ></script>
  
</body>

</html>