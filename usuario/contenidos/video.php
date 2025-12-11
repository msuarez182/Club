<?php
include("includes/authModal.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Club Medicable - Video: </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Minimal CSS necesario que Bootstrap no cubre */
    .btn-club {
      background-color: #f79528;
      color: white;
      font-weight: 600;
    }

    .btn-club:hover {
      background-color: #e07000;
      color: white;
    }

    .topbar {
      background-color: #243e52;
      min-height: 45px;
    }



    .video-container {
      box-shadow: 0 0 0 8px black;
      background: black;
    }

    .related-video-play-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60px;
      height: 60px;
      background: rgba(255, 255, 255, 0.75);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .related-video-play-icon:after {
      content: "";
      display: inline-block;
      margin-left: 4px;
      border-style: solid;
      border-width: 12px 0 12px 20px;
      border-color: transparent transparent transparent #000;
    }

    footer {
      background-color: #243e52;
    }
  </style>
</head>

<body>
  <!-- Page Content -->
  <div class="container mt-4 mb-5">
    <!-- Title block -->
    <h2 class="text-center mb-3">
      ¿CUÁLES SON LOS SÍNTOMAS DE ALERTA<br> PARA INDICAR LA PRESENCIA DE DIABETES?
    </h2>
    <p class="text-center text-warning mb-4">
      En este video el especialista en diabetes,<br>
      el Dr. Jorge Vázquez nos dice cuáles son los síntomas<br>
      que nos indican que alguien puede ser diabético.
    </p>

    <!-- Video Frame -->
    <div class="video-container ratio ratio-16x9 mx-auto mb-5">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2ff36cc8-54fc-4fce-8475-3699e20f1bcf.png" class="img-fluid" alt="Medición de glucosa en sangre">
      <div class="position-absolute top-50 start-50 translate-middle">
        <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
          <circle cx="50" cy="50" r="48" stroke="white" stroke-opacity="0.8" stroke-width="4" />
          <circle cx="50" cy="50" r="38" stroke="white" stroke-opacity="0.4" stroke-width="8" />
          <polygon points="40,35 70,50 40,65" fill="white" />
        </svg>
      </div>
    </div>

    <!-- Related Videos -->
    <h3 class="text-center text-warning mb-4">VIDEOS QUE TE PUEDEN INTERESAR</h3>
    <div class="row g-3 mb-5">
      <div class="col-md-6">
        <div class="position-relative">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/86b514a5-ce3a-4975-95a9-8d524ca64465.png" class="img-fluid rounded" alt="Pie diabético">
          <div class="related-video-play-icon"></div>
        </div>
        <p class="text-center mt-2">Pie diabético</p>
      </div>
      <div class="col-md-6">
        <div class="position-relative">
          <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8aafb6b0-7b95-44a8-a042-57e0e22d949a.png" class="img-fluid rounded" alt="Función del páncreas">
          <div class="related-video-play-icon"></div>
        </div>
        <p class="text-center mt-2">¿Cuál es la función del páncreas?</p>
      </div>
    </div>


    <?php include("../includes/banner.php"); ?>
    <!-- Infographic Section -->
    <div class="d-flex flex-column flex-md-row bg-light p-3 rounded mb-5">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/344997aa-cb8d-4ad4-8746-c8d915a8fa7a.png" class="img-fluid me-md-3 mb-3 mb-md-0" style="max-width: 190px;" alt="Infografía diabetes">
      <div>
        <h6 class="text-warning">INFOGRAFÍA RECOMENDADO</h6>
        <p>
          Los <strong>Estándares de Atención en Diabetes</strong> son guías clínicas que establecen las recomendaciones actuales de la Asociación Estadounidense de Diabetes (ADA) para la práctica clínica en la diabetes.
        </p>
        <p>
          Su objetivo es proporcionar a los profesionales de la salud, pacientes y público en general los componentes esenciales de la atención de la diabetes,
          los objetivos de tratamiento y las herramientas para evaluar la calidad de la atención.
        </p>
        <a href="#" class="text-primary fw-bold">Ver infografía</a>
      </div>
    </div>
  </div>

  <?php include("../includes/footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>