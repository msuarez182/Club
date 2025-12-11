<?php
include("../usuario/includes/authModal.php");
require_once __DIR__ . '/../../includes/database/dbMedicable.php';
require_once __DIR__ . '/../../includes/funciones.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Medicable - Artículos sobre Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="bg-light">

    <!-- Contenido principal -->
    <main class="container py-4">
        <!-- Sección superior -->
        <div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm">
            
        

        
        </div>
    </main>
    <?php include("../usuario/includes/banner.php"); ?>
    <?php include("../usuario/includes/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Restablecer filtros
            document.getElementById('reset-filters').addEventListener('click', function() {
                window.location.href = window.location.pathname;
            });

            // Actualizar el campo oculto de página cuando se aplican filtros
            document.getElementById('filter-form').addEventListener('submit', function() {
                document.getElementById('pagina-hidden').value = 1;
            });



        });
    </script>
</body>

</html>
<?php

?>