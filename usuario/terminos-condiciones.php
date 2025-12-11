<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - Club Medicable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
        }
        
        .main-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .document-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            font-size: 2rem;
        }
        
        .section-title {
            color: #e67e22;
            font-weight: 600;
            margin: 30px 0 15px;
            font-size: 1.4rem;
        }
        
        .last-update {
            color: #7f8c8d;
            font-style: italic;
            text-align: right;
            margin-bottom: 30px;
        }
        
        .text-justify {
            text-align: justify;
        }
        
        .btn-back {
            background-color: #e67e22;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }
        
        .btn-back:hover {
            background-color: #d35400;
            color: white;
        }
        
        @media (max-width: 576px) {
            .main-container {
                padding: 25px;
            }
            
            .document-title {
                font-size: 1.6rem;
            }
        }
    </style>
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