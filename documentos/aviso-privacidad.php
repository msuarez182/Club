<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
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
      <h1 class="document-title">AVISO DE PRIVACIDAD</h1>
      <p class="last-update">Última actualización: <span id="current-date"></span></p>
      
      <p><strong>Club Medicable</strong> ("nosotros", "nuestra aplicación" o "el servicio") se compromete a proteger la privacidad de los usuarios ("tú" o "usuario"). Este aviso explica cómo recopilamos, usamos y protegemos tu información personal.</p>

      <h3 class="section-title">1. Información que recopilamos</h3>
      <ul>
          <li><strong>Datos personales:</strong> Nombre, correo electrónico, edad, tipo de diabetes (opcional), y otros datos relevantes para el registro.</li>
          <li><strong>Datos de salud:</strong> Información sobre tu condición médica (diabetes), que nos proporciones voluntariamente.</li>
          <li><strong>Uso de la plataforma:</strong> Interacciones con videos, artículos, infografías y sesiones virtuales.</li>
          <li><strong>Técnicos:</strong> Dirección IP, tipo de dispositivo, navegador y cookies (ver sección 4).</li>
      </ul>

      <h3 class="section-title">2. Finalidad del tratamiento</h3>
      <p>Usamos tus datos para:</p>
      <ul>
          <li>Brindarte acceso a contenido personalizado (videos, infografías, artículos).</li>
          <li>Notificarte sobre sesiones virtuales o actualizaciones.</li>
          <li>Mejorar la experiencia en la aplicación.</li>
          <li>Cumplir con obligaciones legales.</li>
      </ul>

      <h3 class="section-title">3. Bases legales</h3>
      <p>El tratamiento se basa en:</p>
      <ul>
          <li>Tu consentimiento explícito (al registrarte).</li>
          <li>Interés legítimo (mejora del servicio).</li>
          <li>Cumplimiento de leyes aplicables.</li>
      </ul>

      <h3 class="section-title">4. Cookies y tecnologías similares</h3>
      <p>Usamos cookies para:</p>
      <ul>
          <li>Recordar tu sesión y preferencias.</li>
          <li>Analizar el tráfico con herramientas como Google Analytics (datos anónimos).</li>
      </ul>
      <p>Puedes gestionarlas en la configuración de tu navegador.</p>

      <h3 class="section-title">5. Derechos ARCO</h3>
      <p>Tienes derecho a:</p>
      <ul>
          <li><strong>Acceder</strong> a tus datos.</li>
          <li><strong>Rectificar</strong> información incorrecta.</li>
          <li><strong>Cancelar</strong> tu cuenta.</li>
          <li><strong>Oponerte</strong> al tratamiento.</li>
          <li>Ejercer estos derechos enviando un correo a <a href="mailto:privacidad@clubmedicable.com">privacidad@clubmedicable.com</a>.</li>
      </ul>

      <h3 class="section-title">6. Seguridad</h3>
      <p>Implementamos medidas técnicas (encriptación, autenticación) para proteger tus datos. Sin embargo, ninguna plataforma es 100% invulnerable.</p>

      <h3 class="section-title">7. Cambios al aviso</h3>
      <p>Notificaremos modificaciones mediante la aplicación o tu correo electrónico.</p>

      <h3 class="section-title">8. Contacto</h3>
      <p>Para dudas sobre privacidad, escríbenos a: <a href="mailto:privacidad@clubmedicable.com">privacidad@clubmedicable.com</a>.</p>
      
      <div class="text-center mt-4">
          <a href="<?php echo $base_path; ?>usuario/inicio.php" class="btn-back">
              <i class="fas fa-arrow-left me-2"></i> Volver al inicio
          </a>
      </div>
    </div>
  </div>
  
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <script>
    // Actualizar fecha automáticamente
    document.getElementById('current-date').textContent = new Date().toLocaleDateString('es-MX', {
        year: 'numeric', 
        month: 'long', 
        day: 'numeric'
    });
    
    // Añadir clase activa al menú
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.menu-item a');
        menuItems.forEach(item => {
            if (item.textContent.includes('Aviso de Privacidad')) {
                item.classList.add('active');
            }
        });
    });
  </script>
  <?php include("includes/footer.php"); ?>
</body>
</html>