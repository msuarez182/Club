<?php
include("../usuario/includes/authModal.php");
require_once __DIR__ . '/../includes/database/dbClub.php';
require_once __DIR__ . '/../includes/funciones.php';

//leyendo el token de la url
$token = $_GET['token'] ?? '';
$token = sanitizar($token);

$error = false;

//buscar el token
$query = "SELECT * FROM usuarios WHERE token = " . "'$token'";
$resultado = $dbClub->query($query);
$num_rows = $resultado->num_rows;

//si no existe el token 
if (!$num_rows) {
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Medicable - Artículos sobre Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../usuario/assets/css/formularioReset.css">

</head>

<body class="bg-light">

    <!-- Contenido principal -->
    <main class="container py-4 mt-4">
        <!-- Sección superior -->
        <?php if (!$error) { ?>
            <div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm form-password">

                <!-- Formulario de restablecer password -->
                <form class="auth-form active" id="validar-token" method="POST" novalidate>


                    <div class="mb-3 password-input-group">
                        <label for="password1" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password1" name="password1" required placeholder="Tu nueva contraseña">
                        <span class="password-toggle" id="passwordToggle1">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                    <div class="mb-3 password-input-group">
                        <label for="password2" class="form-label">Confirma contraseña</label>
                        <input type="password" class="form-control" id="password2" name="password2" required placeholder="Confirma tu contraseña">
                        <span class="password-toggle" id="passwordToggle2">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                    <div class="mb-3 animate__animated animate__shakeX" id="token-alertas">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-auth">Restablecer contraseña</button>
                    </div>

                    <div class="auth-nav">
                        <button type="button" class="auth-nav-btn" id="showLogin">Iniciar sesión</button>
                        <span style="margin: 0 10px; color: #ccc;">|</span>
                        <button type="button" class="auth-nav-btn" id="showRegister">Regístrate</button>
                    </div>
                </form>
            </div>
        <?php } else { ?>
            <div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm form-password">
            <h2 class="text-center text-danger fw-bold">Error! token no válido</h2>
            </div>
        <?php } ?>
    </main>

    <?php include("../usuario/includes/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../usuario/assets/js/auth/validarToken.js" type="module" ></script>
    <script src="../usuario/assets/js/auth/Registro.js" type="module" ></script>
    <script src="../usuario/assets/js/auth/Login.js" type="module" ></script>
    <script src="../usuario/assets/js/auth/recoveryPassword.js" type="module" ></script>
    <script src="../usuario/assets/js/auth/modalRecoveryLogin.js" type="module" ></script>

</body>

</html>
<?php

?>