<?php
session_start();
require_once __DIR__ . '../../../includes/database/dbMedicable.php';
require_once __DIR__ . '../../../includes/funciones.php';
// Verificar login
isLogin();
// Ahora incluir el header
include("../includes/authModal.php");
// Verificar si el usuario está logueado
if (!isset($_SESSION['correo'])) {
  header('Location: ../login.php');
  exit();
}

$correo = $_SESSION['correo'];
$query = "SELECT * FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($dbClub, $query);
$usuario = mysqli_fetch_assoc($resultado);
// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recoger y sanitizar los datos del formulario
  $nombre = sanitizar($_POST['nombre']);
  $apellidos = sanitizar($_POST['apellidos']);
  $tipoUsuario = sanitizar($_POST['tipo_usuario']);
  $correo_form = sanitizar($_POST['correo']);
  $fecha_nacimiento = sanitizar($_POST['fecha_nacimiento']);
  $pais = sanitizar($_POST['pais']);
  $cp = sanitizar($_POST['codigo_postal']);

  // Verificar si se cambió la contraseña
  $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $usuario['password'];

  try {
    // Actualizar los datos en la base de datos
    $update_query = $pdo->prepare("UPDATE usuarios SET 
                                      nombre = ?, 
                                      apellidos = ?, 
                                      tipo_usuario = ?, 
                                      correo = ?, 
                                      fecha_nacimiento = ?, 
                                      password = ?, 
                                      pais = ?, 
                                      codigo_postal = ? 
                                      WHERE id = ?");

    $update_query->execute([
      $nombre,
      $apellidos,
      $tipoUsuario,
      $correo_form,
      $fecha_nacimiento,
      $password,
      $pais,
      $cp,
      $usuario['id']
    ]);

    // Actualizar la sesión con el nuevo correo si cambió
    $_SESSION['correo'] = $correo_form;

    // Redirigir para evitar reenvío del formulario
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  } catch (PDOException $e) {
    $error = "Error al actualizar los datos: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Perfil - Club Medicable</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/perfil.css">
</head>

<body>


  <div class="container py-4">
    <div class="main-container">
      <h1 class="profile-title">EDITAR PERFIL</h1>

      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="alert alert-success">Perfil actualizado correctamente</div>
      <?php endif; ?>

      <!-- Formulario de Edición de Perfil -->
      <form id="profileForm" method="POST" action="">
        <!-- Sección de Información Básica -->
        <div class="mb-5">
          <h3 class="section-title">
            <i class="fas fa-user-edit me-2"></i>INFORMACIÓN PERSONAL
          </h3>

          <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
              <label for="firstName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="firstName" name="nombre" required value="<?php echo sanitizar($usuario['nombre']); ?>">
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Apellido paterno</label>
              <input type="text" class="form-control" id="lastName" name="apellidos" value="<?php echo sanitizar($usuario['apellido_paterno']); ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
              <label for="userType" class="form-label">Tipo de usuario</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                <input type="text" class="form-control readonly-field" id="userType" name="tipoUsuario"
                  value="<?php echo sanitizar($usuario['tipo_usuario']); ?>" readonly>
              </div>
              <small class="form-text text-muted">El tipo de usuario no puede ser modificado</small>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="correo" value="<?php echo sanitizar($usuario['correo']); ?>" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
              <label for="birthDate" class="form-label">Fecha de nacimiento</label>
              <input type="date" class="form-control datepicker" id="birthDate" name="fecha_nacimiento" placeholder="dd/mm/aaaa" value="<?php echo sanitizar($usuario['fecha_nacimiento']); ?>">
            </div>
            <div class="col-md-6">
              <label for="country" class="form-label">País</label>
              <select class="form-select" id="country" name="pais" required>
                <option value="">Seleccionar</option>
                <?php
                $countryNames = [
                  'MX' => 'México',
                  'US' => 'Estados Unidos',
                  'CA' => 'Canadá',
                  'ES' => 'España',
                  'CO' => 'Colombia',
                  'AR' => 'Argentina',
                  'CL' => 'Chile',
                  'PE' => 'Perú',
                  'EC' => 'Ecuador',
                  'VE' => 'Venezuela',
                  'BR' => 'Brasil',
                  'UY' => 'Uruguay',
                  'PY' => 'Paraguay',
                  'BO' => 'Bolivia',
                  'CR' => 'Costa Rica',
                  'PA' => 'Panamá',
                  'DO' => 'República Dominicana',
                  'GT' => 'Guatemala',
                  'SV' => 'El Salvador',
                  'HN' => 'Honduras',
                  'NI' => 'Nicaragua',
                  'CU' => 'Cuba',
                  'PR' => 'Puerto Rico',
                  'FR' => 'Francia',
                  'DE' => 'Alemania',
                  'IT' => 'Italia',
                  'UK' => 'Reino Unido',
                  'PT' => 'Portugal',
                  'CH' => 'Suiza',
                  'BE' => 'Bélgica',
                  'NL' => 'Países Bajos',
                  'SE' => 'Suecia',
                  'NO' => 'Noruega',
                  'FI' => 'Finlandia',
                  'DK' => 'Dinamarca',
                  'AU' => 'Australia',
                  'NZ' => 'Nueva Zelanda',
                  'JP' => 'Japón',
                  'CN' => 'China',
                  'IN' => 'India',
                  'ZA' => 'Sudáfrica'
                ];

                foreach ($countryNames as $code => $name):
                  $selected = ($code == sanitizar($usuario['pais'])) ? 'selected' : '';
                ?>
                  <option value="<?php echo $code; ?>" <?php echo $selected; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="postalCode" class="form-label">Código postal</label>
            <input type="text" class="form-control" id="postalCode" name="cp" value="<?php echo sanitizar($usuario['codigo_postal']); ?>" required>
          </div>
        </div>

        <!-- Sección de Confirmación de Cambios -->
        <div class="mb-4 password-field" id="confirmChangesSection">
          <h3 class="section-title">
            <i class="fas fa-key me-2"></i>CONFIRMAR CAMBIOS
          </h3>

          <div class="mb-3">
            <label for="password" class="form-label">Ingresa tu contraseña para confirmar los cambios</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password">
              <button class="btn btn-outline-secondary toggle-password" type="button">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-save">
            <i class="fas fa-save me-2"></i>Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </div>

  <?php include("../includes/footer.php"); ?>

  <!-- Incluir jQuery y jQuery UI para el datepicker -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(function() {
      // Inicializar datepicker
      $(".datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2023"
      });

      // Mostrar/ocultar contraseña
      $('.toggle-password').click(function() {
        const input = $(this).prev();
        const icon = $(this).find('i');

        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });

      // Mostrar campo de contraseña si hay cambios
      const originalValues = {
        nombre: '<?php echo sanitizar($usuario['nombre']); ?>',
        apellidos: '<?php echo sanitizar($usuario['apellidos']); ?>',
        tipoUsuario: '<?php echo sanitizar($usuario['tipo_usuario']); ?>',
        correo: '<?php echo sanitizar($usuario['correo']); ?>',
        fecha_nacimiento: '<?php echo sanitizar($usuario['fecha_nacimiento']); ?>',
        pais: '<?php echo sanitizar($usuario['pais']); ?>',
        cp: '<?php echo sanitizar($usuario['cp']); ?>'
      };

      function checkForChanges() {
        let hasChanges = false;

        // Verificar cada campo (excepto tipoUsuario que es de solo lectura)
        if ($('#firstName').val() !== originalValues.nombre) hasChanges = true;
        if ($('#lastName').val() !== originalValues.apellidos) hasChanges = true;
        if ($('#email').val() !== originalValues.correo) hasChanges = true;
        if ($('#birthDate').val() !== originalValues.fecha_nacimiento) hasChanges = true;
        if ($('#country').val() !== originalValues.pais) hasChanges = true;
        if ($('#postalCode').val() !== originalValues.cp) hasChanges = true;

        // Mostrar u ocultar la sección de confirmación
        if (hasChanges) {
          $('#confirmChangesSection').show();
          $('#password').prop('required', true);
        } else {
          $('#confirmChangesSection').hide();
          $('#password').prop('required', false);
        }
      }

      // Escuchar cambios en los campos
      $('#profileForm').on('input', 'input, select', function() {
        checkForChanges();
      });

      // Validación del formulario
      $('#profileForm').submit(function(e) {
        const password = $('#password').val();
        const hasChanges = $('#confirmChangesSection').is(':visible');

        // Si hay cambios, requerir contraseña
        if (hasChanges && password === '') {
          alert('Por favor ingresa tu contraseña para confirmar los cambios');
          e.preventDefault();
          return;
        }
      });

      // Verificar cambios al cargar la página (por si hay valores previamente ingresados)
      checkForChanges();
    });
  </script>
</body>

</html>