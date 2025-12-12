<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - Club Medicable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/terminos-condiciones.css">

</head>
<body>
  <?php include("includes/authModal.php"); ?>
  
  <div class="container py-4">
    <div class="main-container">
      <h1 class="document-title">TÉRMINOS Y CONDICIONES DE USO</h1>
      <p class="last-update">Última actualización: <?php echo date('d/m/Y'); ?></p>
      
      <h3 class="section-title">1. Aceptación de los Términos</h3>
      <p class="text-justify">Al acceder y utilizar el sitio web de Club Medicable, usted acepta cumplir con estos términos y condiciones, y todas las leyes y regulaciones aplicables.</p>
      
      <h3 class="section-title">2. Uso del Sitio</h3>
      <p class="text-justify">El contenido del sitio es solo para información general. Nos reservamos el derecho de modificar o discontinuar el servicio sin previo aviso.</p>
      
      <h3 class="section-title">3. Cuentas de Usuario</h3>
      <p class="text-justify">Al crear una cuenta, usted es responsable de mantener la confidencialidad de su información de acceso y de todas las actividades que ocurran bajo su cuenta.</p>
      
      <h3 class="section-title">4. Propiedad Intelectual</h3>
      <p class="text-justify">Todos los materiales, incluyendo textos, gráficos, logotipos e imágenes son propiedad de Club Medicable y están protegidos por las leyes de derechos de autor.</p>
      
      <h3 class="section-title">5. Limitación de Responsabilidad</h3>
      <p class="text-justify">Club Medicable no será responsable por cualquier daño directo, indirecto, incidental o consecuente que resulte del uso o la imposibilidad de usar el sitio.</p>
      
      <h3 class="section-title">6. Modificaciones</h3>
      <p class="text-justify">Podemos revisar estos términos en cualquier momento sin previo aviso. Al usar este sitio, usted acepta estar sujeto a la versión actual de estos términos.</p>
      
      <h3 class="section-title">7. Ley Aplicable</h3>
      <p class="text-justify">Estos términos se regirán e interpretarán de acuerdo con las leyes de México, sin considerar sus disposiciones sobre conflictos de leyes.</p>
      
      <div class="mt-4 p-3 bg-light rounded">
        <p class="text-justify">Si tiene alguna pregunta sobre estos Términos y Condiciones, por favor contáctenos a través de nuestro sitio web.</p>
      </div>

      <div class="text-center mt-4">
        <a href="<?php echo $base_path; ?>usuario/inicio.php" class="btn-back">
          <i class="fas fa-arrow-left me-2"></i> Volver al inicio
        </a>
      </div>
    </div>
  </div>
  
  <?php include("includes/footer.php"); ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>