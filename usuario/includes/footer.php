<footer class="footer mt-5" style="background-color: #f8f9fa; border-top: 1px solid #eeeeee;">
    <div class="container py-4">
        <div class="row justify-content-between">
            <!-- Columna 1: Logo y descripción -->
            <div class="col-md-5 mb-4 mb-md-0">
                <a href="/club/usuario/inicio.php" class="d-inline-block mb-3">
                    <img src="<?php echo base_path(); ?>usuario/assets/img/logo.png" alt="Logo" style="width: 180px; height: auto;">
                </a>
                <p class="small text-muted" style="line-height: 1.6;">
                    Plataforma especializada en salud y bienestar. Conectamos pacientes con profesionales médicos y recursos de calidad.
                </p>
                <!-- Redes sociales -->
                <div class="social-links mt-3">
                    <a href="#" class="text-secondary me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-secondary me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Columna 2: Enlaces rápidos -->
            <div class="col-md-3 mb-4 mb-md-0">
                <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 1px; color: #000000;">Contenido</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?php echo $base_path; ?>usuario/contenidos/articulos.php" class="text-muted small restringido" style="text-decoration: none;">Artículos</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>usuario/contenidos/videos.php" class="text-muted small restringido" style="text-decoration: none;">Videos</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>usuario/contenidos/infografias.php" class="text-muted small restringido" style="text-decoration: none;">Infografías</a></li>
                </ul>
            </div>

            <!-- Columna 3: Legal y contacto -->
            <div class="col-md-4">
                <h6 class="text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 1px; color: #000000;">Legal</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?php echo $base_path; ?>usuario/terminos-condiciones.php" class="text-muted small" style="text-decoration: none;">Términos y Condiciones</a></li>
                    <li class="mb-2"><a href="<?php echo $base_path; ?>usuario/aviso-privacidad.php" class="text-muted small" style="text-decoration: none;">Política de Privacidad</a></li>
                </ul>
                <!-- Contacto -->
                <div class="mt-4">
                    <p class="small text-muted mb-1"><i class="fas fa-envelope me-2"></i> club@medicable.com.mx</p>
                    <p class="small text-muted"><i class="fas fa-phone me-2"></i> +52 55 1234 5678</p>
                </div>
            </div>
        </div>

        <!-- Copyright con año dinámico -->
        <div class="row mt-4 pt-3 border-top">
            <div class="col-12 text-center">
                <p class="small text-muted mb-0">&copy; <span id="currentYear"></span> Club Medicable. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Script para año actual -->
<script>
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>