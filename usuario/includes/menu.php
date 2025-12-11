<?php 
$base_path = '/club/';
?>

<style>
    :root {
        --primary-color: #000000;
        --secondary-color: #000000; /* Cambiado de gris a negro */
        --hover-color: #e63946;
        --bg-color: #ffffff;
        --section-border: #eeeeee;
    }
    
    body {
        font-family: 'Acumin Variable Concept', sans-serif;
        overflow-x: hidden;
        padding-top: 70px; /* Espacio para el header fijo */
    }
    
    /* Header fijo */
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1002;
        height: 80px;
        background-color: #f8f9fa;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    /* Línea dorada/café debajo del header */
    header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #eb9022;
        z-index: 1003;
    }
    
    /* Botón hamburguesa estilo premium - Más grande y con más aire */
    .hamburger-btn {
        padding: 18px 15px; /* Más espacio vertical */
        font-size: 1.1rem; /* Un poco más grande */
        font-weight: 500;
        border: none;
        background: none;
        display: flex;
        align-items: center;
        z-index: 1001;
        letter-spacing: 1px;
        color: var(--primary-color);
        position: relative;
    }
    
    .hamburger-btn .navbar-toggler-icon {
        width: 24px; /* Un poco más grande */
        height: 2px;
        background: var(--primary-color);
        position: relative;
        margin-right: 12px;
    }
    
    .hamburger-btn .navbar-toggler-icon:before,
    .hamburger-btn .navbar-toggler-icon:after {
        content: '';
        position: absolute;
        width: 24px; /* Un poco más grande */
        height: 2px;
        background: var(--primary-color);
        left: 0;
        transition: all 0.3s ease;
    }
    
    .hamburger-btn .navbar-toggler-icon:before {
        top: -7px;
    }
    
    .hamburger-btn .navbar-toggler-icon:after {
        top: 7px;
    }
    
    .hamburger-btn.active .navbar-toggler-icon {
        background: transparent;
    }
    
    .hamburger-btn.active .navbar-toggler-icon:before {
        transform: rotate(45deg);
        top: 0;
    }
    
    .hamburger-btn.active .navbar-toggler-icon:after {
        transform: rotate(-45deg);
        top: 0;
    }
    
    /* Menú desplegable */
    .dropdown-menu {
        background-color: var(--bg-color);
        position: fixed;
        left: 20px;
        top: 70px;
        height: auto;
        max-height: 65vh;
        z-index: 1000;
        transform: translateX(-100%) translateY(10px);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
        width: 380px;
        max-width: calc(90% - 20px);
        padding: 0;
        box-shadow: 5px 15px 30px rgba(0,0,0,0.15);
        border-radius: 20px;
        overflow: hidden;
        opacity: 0;
        margin-top: 10px;
        border: none;
    }

    .dropdown-menu.show {
        transform: translateX(0) translateY(0);
        opacity: 1;
        box-shadow: 10px 20px 40px rgba(0,0,0,0.2);
    }
    
    .menu-content {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Cambiado a 2 columnas */
        gap: 12px;
        padding: 20px;
        padding-top: 0;
    }
    
    .menu-section {
        margin-bottom: 10px;
        opacity: 0;
        transform: translateX(-20px);
        transition: all 0.4s ease;
    }
    
    .dropdown-menu.show .menu-section {
        opacity: 1;
        transform: translateX(0);
    }
    
    /* Transiciones escalonadas */
    .dropdown-menu.show .menu-section:nth-child(1) { transition-delay: 0.1s; }
    .dropdown-menu.show .menu-section:nth-child(2) { transition-delay: 0.15s; }
    .dropdown-menu.show .menu-section:nth-child(3) { transition-delay: 0.2s; }
    .dropdown-menu.show .menu-section:nth-child(4) { transition-delay: 0.25s; }
    .dropdown-menu.show .menu-section:nth-child(5) { transition-delay: 0.3s; }
    
    .menu-section-title {
        font-size: 0.85rem;
        font-weight: 700; /* Más negrita */
        color: var(--primary-color);
        margin-bottom: 8px;
        padding-bottom: 4px;
        border-bottom: 1px solid var(--section-border);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    
    .menu-item {
        padding: 4px 0;
    }
    
    .menu-item a {
        color: var(--secondary-color); /* Ahora es negro en lugar de gris */
        text-decoration: none;
        display: block;
        font-size: 0.8rem;
        font-weight: 400;
        transition: all 0.3s ease;
        letter-spacing: 0.3px;
        line-height: 1.4;
    }
    
    .menu-item a:hover {
        color: var(--hover-color);
        padding-left: 4px;
    }
    
   /* Logo centrado - Versión con más aire */
.brand-center {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    z-index: 999;
    padding: 90px 90px; /* Añade espacio arriba y abajo */
}

.brand-center img {
    width: 360px !important;
    height: auto;
    display: block;
    margin: 0 auto;
    max-height: 120px;
    object-fit: contain;
    padding: 10px 0; /* Alternativa: espacio adicional directamente en la imagen */
}
.brand-center {
    padding: 15px 0; /* 15px arriba y abajo, 0 a los lados */
}
.brand-center img {
    margin: 15px auto; /* 15px arriba/abajo, auto para centrado horizontal */
}
    /* Navbar ajustado */
    .navbar {
        height: 100%;
        padding: 0;
    }
    
    .container-fluid {
        height: 100%;
        position: relative;
    }
    
    /* Overlay */
    .menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 990;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.4s ease;
    }
    
    .menu-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    /* Cerrar sesión */
    .logout-section {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid var(--section-border);
        grid-column: 1 / -1;
        order: 4; /* Mover al final */
    }
    
    .logout-item a {
        color: var(--hover-color) !important;
        font-weight: 500;
        font-size: 0.85rem;
    }
    
    /* Redes sociales - Solo iconos */
    .social-section {
        grid-column: 1 / -1; /* Ocupa ambas columnas */
        order: 3; /* Colocar antes de cerrar sesión */
        margin-bottom: 15px;
    }
    
    .social-icons {
        display: flex;
        flex-direction: row; /* Cambiado a horizontal */
        gap: 20px;
        margin-top: 10px;
        justify-content: center;
    }
    
    .social-icons a {
        color: var(--secondary-color);
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
    }
    
    /* Colores reales de redes sociales */
    .social-icons a[title="Facebook"] { color: #1877F2; }
    .social-icons a[title="Instagram"] { color: #E4405F; }
    .social-icons a[title="YouTube"] { color: #FF0000; }
    .social-icons a[title="Twitter"] { color: #1DA1F2; }
    
    .social-icons a:hover {
        transform: scale(1.1);
    }

    /* Control del scroll */
    body.menu-open {
        overflow: hidden;
    }
    
    /* Sección de información del usuario */
    .user-info-section {
        grid-column: 1 / -1;
        padding: 15px 20px;
        margin: 0 -20px 15px -20px;
        background: linear-gradient(135deg, #f5f5f5 0%, #e9e9e9 100%);
        border-bottom: 1px solid var(--section-border);
        border-radius: 20px 20px 0 0;
    }
    
    .user-email {
        font-size: 0.85rem;
        font-weight: 600; /* Más negrita */
        color: var(--primary-color);
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .user-role {
        display: inline-block;
        font-size: 0.7rem;
        font-weight: 700; /* Más negrita */
        padding: 3px 8px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .role-admin {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ef9a9a;
    }
    
    .role-user {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #a5d6a7;
    }
    
    .role-editor {
        background-color: #e3f2fd;
        color: #1565c0;
        border: 1px solid #90caf9;
    }
    
    .role-guest {
        background-color: #fff3e0;
        color: #e65100;
        border: 1px solid #ffcc80;
    }
</style>

<header>
    <nav class="navbar navbar-light">
        <div class="container-fluid">
            <!-- Botón hamburguesa -->
            <button class="hamburger-btn navbar-toggler" type="button" id="menuToggle">
                <span class="navbar-toggler-icon"></span>
                <span></span>
            </button>
            
            <!-- Logo con ruta absoluta -->
            <div class="brand-center">
                <a href="<?php echo $base_path; ?>usuario/inicio.php">
                    <img src="<?php echo $base_path; ?>usuario/assets/img/logo.png" alt="Logo" class="img-fluid">
                </a>
            </div>
            
            <!-- Overlay -->
            <div class="menu-overlay" id="menuOverlay"></div>
            
            <!-- Menú desplegable con rutas corregidas y orden alfabético -->
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="menu-content">
                    <!-- Sección de información del usuario -->
                    <div class="user-info-section">
                       
                    </div>
                    
                    <!-- Primera columna -->
                    <div>
                        <div class="menu-section">
                            <div class="menu-section-title">Contenido</div>
                            <div class="menu-item"><a href="<?php echo $base_path; ?>usuario/contenidos/articulos.php">Artículos</a></div>
                            <div class="menu-item"><a href="<?php echo $base_path; ?>usuario/contenidos/infografias.php">Infografías</a></div>
                            <div class="menu-item"><a href="<?php echo $base_path; ?>usuario/contenidos/videos.php">Videos</a></div>
                        </div>
                        
                        <div class="menu-section">
                            <div class="menu-section-title">Legal</div>
                            <div class="menu-item"><a href="<?php echo $base_path; ?>usuario/aviso-privacidad.php">Aviso de Privacidad</a></div>
                            <div class="menu-item"><a href="<?php echo $base_path; ?>usuario/terminos-condiciones.php">Términos y Condiciones</a></div>
                        </div>
                    </div>
                    
                    <!-- Segunda columna -->
                    <div>
                        <div class="menu-section">
                            
                        </div>
                        
                        <div class="menu-section">
                            <div class="menu-section-title">Webinars</div>
                            <div class="menu-item"><a href="<?php echo $base_path; ?>usuario/webinars/sesiones-virtuales.php">Sesiones Virtuales</a></div>
                        </div>
                    </div>
                    
                    <!-- Tercera sección - Redes Sociales (ahora abarca ambas columnas) -->
                    <div class="social-section">
                        <div class="menu-section">
                            <div class="menu-section-title">Siguenos en</div>
                            <div class="social-icons">
                                <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cerrar Sesión -->
                    <div class="menu-section logout-section">
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Contenido principal de tu página -->
<main class="container mt-4">
    <!-- Aquí va el contenido de tu página -->
</main>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        dropdownMenu.classList.toggle('show');
        menuOverlay.classList.toggle('show');
        document.body.classList.toggle('menu-open');
    });
    
    menuOverlay.addEventListener('click', closeMenu);
    document.querySelectorAll('.menu-item a, .social-icons a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    function closeMenu() {
        menuToggle.classList.remove('active');
        dropdownMenu.classList.remove('show');
        menuOverlay.classList.remove('show');
        document.body.classList.remove('menu-open');
    }
</script>