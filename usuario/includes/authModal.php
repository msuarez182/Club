<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '../../../includes/database/dbClub.php';
require_once __DIR__ . '../../../includes/funciones.php';

// Verificar si el usuario está logueado
$usuarioLogueado = $_SESSION['login'] ?? '';
//guarda en localstorage para despues buscar con js
if ($usuarioLogueado) {
    echo "<script>localStorage.setItem('usuarioLogueado',true)</script>";
} else {
    echo "<script>localStorage.setItem('usuarioLogueado',false)</script>";
}


$base_path = '/club/';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Medicable</title>
    <link rel="shortcut icon" href="/club/usuario/assets/img/ClubMedicableIco.ico" type="image/x-icon">
    <link rel="stylesheet" href="/club/usuario/assets/css/authModal.css">
</head>
<header>
    <nav class="navbar navbar-light">
        <div class="container-fluid">
            <!-- Botón hamburguesa -->
            <!-- navbar-toggler -->
            <button class="hamburger-btn" type="button" id="menuToggle">
                <span class="navbar-toggler-icon"></span>
                <span></span>
            </button>

            <!-- Logo con ruta absoluta - MÁS GRANDE -->
            <div class="brand-center">
                <a href="<?php echo $base_path; ?>usuario/inicio.php" id="logoLink">
                    <img src="<?php echo $base_path; ?>usuario/assets/img/logo.png" alt="Logo" class="img-fluid">
                </a>
            </div>

            <!-- Imagen responsiva a la derecha - MÁS PEQUEÑA -->
            <div class="header-right-image">
                <img src="<?php echo $base_path; ?>usuario/assets/img/vivircondiabetes.png" alt="Vivir con diabetes" class="img-fluid">
            </div>

            <!-- Overlay -->
            <div class="menu-overlay" id="menuOverlay"></div>

            <!-- Menú desplegable con rutas corregidas y orden alfabético -->
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="menu-content">
                    <?php if ($usuarioLogueado): ?>
                        <!-- Sección de información del usuario con botón de cerrar sesión integrado -->
                        <div class="user-info-section">
                            <div class="user-info-content">
                                <div class="user-avatar">
                                    <?php
                                    // Mostrar iniciales del usuario
                                    $iniciales = substr($_SESSION['nombre'], 0, 1) . substr($_SESSION['apellidoPaterno'], 0, 1);
                                    echo $iniciales;
                                    ?>
                                </div>
                                <div class="user-details">
                                    <div class="user-name"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidoPaterno']; ?></div>
                                    <div class="user-email"><?php echo $_SESSION['correo']; ?></div>
                                    <div class="user-role <?php echo  'role-user'; ?>">
                                        <?php echo $_SESSION['tipo_usuario']; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Botón de cerrar sesión como icono - CORREGIDO -->
                            <div class="logout-icon">
                                <a href="" class="logout-btn" id="logoutBtn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="logout-tooltip">Cerrar Sesión</span>
                                </a>
                            </div>
                        </div>

                        <!-- Primera columna -->
                        <div>
                            <div class="menu-section">
                                <div class="menu-section-title">Contenido</div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/contenidos/articulos.php' : '#'; ?>" class="menu-link">Artículos</a></div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/contenidos/infografias.php' : '#'; ?>" class="menu-link">Infografías</a></div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/contenidos/videos.php' : '#'; ?>" class="menu-link">Videos</a></div>
                            </div>

                            <div class="menu-section">
                                <div class="menu-section-title">Legal</div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/aviso-privacidad.php' : '#'; ?>" class="menu-link">Aviso de Privacidad</a></div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/terminos-condiciones.php' : '#'; ?>" class="menu-link">Términos y Condiciones</a></div>
                            </div>
                        </div>

                        <!-- Segunda columna -->
                        <div>
                            <div class="menu-section">
                                <div class="menu-section-title">Configuración</div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/contenidos/perfil.php' : '#'; ?>" class="menu-link">Perfil</a></div>
                            </div>

                            <div class="menu-section">
                                <div class="menu-section-title">Webinars</div>
                                <div class="menu-item"><a href="<?php echo $usuarioLogueado ? $base_path . 'usuario/webinars/sesiones-virtuales.php' : '#'; ?>" class="menu-link">Sesiones Virtuales</a></div>
                            </div>
                        </div>

                        <!-- Tercera sección - Redes Sociales -->
                        <div class="social-section">
                            <div class="menu-section">
                                <div class="menu-section-title">Siguenos en</div>
                                <div class="social-icons">
                                    <a href="#" title="Facebook" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" title="Instagram" class="social-link"><i class="fab fa-instagram"></i></a>
                                    <a href="#" title="YouTube" class="social-link"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- Mensaje para usuarios no logueados -->
                        <div class="user-info-section">
                            <div class="guest-info">
                                <div class="guest-icon">
                                    <i class="fas fa-user-circle display-1"></i>
                                </div>
                                <div class="user-email"></div>
                                <div class="user-roles role-guests"></div>
                            </div>
                        </div>

                        <div class="menu-section" style="grid-column: 1 / -1; text-align: center; padding: 15px 0;">
                            <p>Por favor inicia sesión para acceder al contenido</p>
                            <button class="btn btn-primary mt-2" id="loginButtonMenu">Iniciar Sesión</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Modal de Autenticación DINÁMICO -->
<div class="modal fade auth-modal" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Formulario de Login -->
                <form class="auth-form active" id="loginForm" method="POST" novalidate>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email-login" name="correo" required placeholder="tu@email.com" value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>">
                    </div>

                    <div class="mb-3 password-input-group">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password-login" name="password" required placeholder="Tu contraseña">
                        <span class="password-toggle" id="passwordToggle">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                    <div class="mb-3 animate__animated animate__shakeX" id="alertas-login">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                        <label class="form-check-label" for="rememberMe">Recordarme</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-auth">Iniciar Sesión</button>
                    </div>

                    <div class="auth-nav">
                        <button type="button" class="auth-nav-btn" id="showRecovery">¿Olvidaste tu contraseña?</button>
                        <span style="margin: 0 10px; color: #ccc;">|</span>
                        <button type="button" class="auth-nav-btn" id="showRegister">Regístrate</button>
                    </div>
                </form>

                <!-- Formulario de Recuperación de Contraseña -->
                <form class="auth-form" id="recoveryForm" novalidate>
                    <div class="mb-3">
                        <label for="recoveryEmail" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="recoveryEmail" required placeholder="tu@email.com" name="correo">
                    </div>

                    <div class="mb-3 animate__animated animate__shakeX" id="alertas-recovery">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-auth">Recuperar Contraseña</button>
                    </div>

                    <div class="auth-nav">
                        <button type="button" class="auth-nav-btn" id="backToLoginFromRecovery">Volver al Login</button>
                    </div>
                </form>

                <!-- Formulario de Registro -->
                <form class="auth-form" id="formularioRegistro" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required placeholder="Tu nombre">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="apellido-paterno" class="form-label">Apellido paterno</label>
                            <input type="text" class="form-control" id="apellido-paterno" required placeholder="Tu primer apellido" name="apellido_paterno">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido-materno" class="form-label">Apellido materno</label>
                            <input type="text" class="form-control" id="apellido-materno" required placeholder="Tu segundo apellido" name="apellido_materno">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipo_usuario" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="" selected disabled>Selecciona tipo</option>
                                <option value="Paciente">Paciente</option>
                                <option value="Profesional de la salud">Profesional de la salud</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="estudios">
                            <label for="nivel_estudios" class="form-label">Nivel de estudios</label>
                            <select class="form-select" id="nivel_estudios" name="nivel_estudios" required>
                                <option value="" selected disabled>Selecciona nivel</option>
                                <option value="Nivel Universitario">Nivel universitario</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Estudiante/Pasante">Estudiante/Pasante</option>
                            </select>
                        </div>

                    </div>
                    <!-------------------------------------------------------------------------NUEVOS CAMBIOS ------------------------------------------------------------------>
                    <div class="row">


                        <div class="col-md-12 mb-3" id="cedula-profesional">
                            <label for="cedula" class="form-label">Cédula profesional</label>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula profesional" required>
                        </div>

                    </div>

                    <div class="col-md-12 mb-3" id="document">
                        <div class="mas-informacion">
                            <label for="documento" class="mb-2">Documento de acreditación</label>

                            <!-- ICONO SABER MAS -->
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Cargue un documento que acredite sus estudios ej. credencial, matrícula (pdf o imagen)">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="32"
                                    height="32"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="#f28c28"
                                    stroke-width="1.75"
                                    stroke-linecap="round"
                                    class="mb-2"
                                    stroke-linejoin="round"

                                    data-bs-title="Información"
                                    
                                    
                                    id="informacion">
                                    <path d="M12.802 2.165l5.575 2.389c.48 .206 .863 .589 1.07 1.07l2.388 5.574c.22 .512 .22 1.092 0 1.604l-2.389 5.575c-.206 .48 -.589 .863 -1.07 1.07l-5.574 2.388c-.512 .22 -1.092 .22 -1.604 0l-5.575 -2.389a2.036 2.036 0 0 1 -1.07 -1.07l-2.388 -5.574a2.036 2.036 0 0 1 0 -1.604l2.389 -5.575c.206 -.48 .589 -.863 1.07 -1.07l5.574 -2.388a2.036 2.036 0 0 1 1.604 0z" />
                                    <path d="M12 16v.01" />
                                    <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                                </svg>
                            </span>





                        </div>

                        <input type="file" name="documento" id="documento" accept=".pdf">


                    </div>

                    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="codigo_postal" class="form-label">Código postal</label>
                            <input type="text" class="form-control" id="codigo_postal" required placeholder="Ej: 28001" maxlength="5" name="codigo_postal">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" required placeholder="tu@email.com" name="correo">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 password-input-group">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password_1" required placeholder="Crea una contraseña">
                            <span class="password-toggle" id="registerPasswordToggle">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>

                        <div class="col-md-6 mb-3 password-input-group">
                            <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirm" required placeholder="Confirma tu contraseña" name="password">
                            <span class="password-toggle" id="registerConfirmPasswordToggle">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Acepto los <a href="terminos-condiciones.php" target="_blank" class="terminos-condiciones">términos y condiciones</a></label>
                    </div>

                    <div class="mb-3 animate__animated animate__shakeX" id="alertas">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-auth">Registrarse</button>
                    </div>

                    <div class="auth-nav">
                        <button type="button" class="auth-nav-btn" id="backToLoginFromRegister">Volver al Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/4e918dc7e0.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ruta absoluta para evitar errores -->
<script src="/club/usuario/assets/js/auth/Registro.js" type="module"></script>
<script src="/club/usuario/assets/js/auth/Login.js" type="module"></script>
<script src="/club/usuario/assets/js/auth/recoveryPassword.js" type="module"></script>
<script src="/club/usuario/assets/js/auth/authModal.js" type="module"></script>