<?php
session_start();
require_once('../../includes/database/dbClub.php');
require_once('../../includes/funciones.php');

include("../includes/authModal.php");
$usuarioLogueado = $_SESSION['login'] ?? ''; //esta Logueado?
$id_sv = sanitizar($_GET['id']); //trae el id de la sv de la url

//toma valor del id de usuario y el id de la sv que estamos visitando
if ($usuarioLogueado) {

    $id_usuario = $_SESSION['id'];
    $confirme_asistencia = true; //Debe registrarse a ese webinar


    //verifica si ya existe el id de usuario en en la tabla sv
    $query = "SELECT * FROM sv_usuario WHERE usuarioId = '$id_usuario' AND svId='$id_sv' ";
    $resultado = $dbClub->query($query);
    if ($resultado->num_rows) {
        $confirme_asistencia = false; //ya no necesita confirmar, ya esta registrado en esa sv
    } else {
        $confirme_asistencia = true; //si debe registrarse en ese webinar
    }
}

//trae todos los datos de la publicación de la sv
$sql = "SELECT * FROM sv WHERE id={$id_sv}";
$resultado = $dbClub->query($sql);
$sv = $resultado->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Medicable - Artículos sobre Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/sesion-virtual.css">

</head>



<body class="bg-light ">

    <!-- Contenido principal -->
    <main class="container py-4">
        <!-- Sección superior -->
        <div class="bg-white rounded-3 p-4 p-md-5 mb-4 shadow-sm">

            <!-- Encabezado de sv -->
            <section class="article-header">
                <div class="text-center">
                    <h1 class="3-title"><?= sanitizar($sv['titulo']) ?></h1>
                </div>

                <?php if ($sv['link_video']): ///si existe un link de video en la bd
                ?>

                    <!-- Elimina el boton de confirme y muestra el video y el contenido de la publicación  -->
                    <div class="video-sv">
                        <?php

                        if (!$usuarioLogueado) { //si no esta logueado solo muestra la portada del video en youtube
                            $idVideo = explode('=', $sv['link_video']);


                        ?>

                            <div class="tumb youtube-style-player <?php echo !$usuarioLogueado ? 'restringido' : '' ?>">

                                <!-- Miniatura -->
                                <img src="https://img.youtube.com/vi/<?php echo $idVideo[1] ?>/maxresdefault.jpg"
                                    alt="Vista previa del video">

                                <!-- Botón Play -->
                                <div class="youtube-play-button">
                                    <svg viewBox="0 0 68 48">
                                        <path d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 
                     C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,
                     2.49,5.41,5.42,6.19C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,
                     4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"
                                            fill="#f00"></path>
                                        <path d="M 45,24 27,14 27,34" fill="#fff"></path>
                                    </svg>
                                </div>

                                <!-- Barra superior  -->
                                <div class="titulo-video">
                                    <p><?php echo $sv['titulo'] ?></p>
                                </div>
                                <!-- Footer estilo YouTube -->
                                <div class="yt-footer">
                                    <!-- Ícono oficial de YouTube en SVG -->
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="red" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.5 6.2s-.2-1.7-.8-2.5c-.8-.9-1.6-.9-2-1C17.2 2.3 12 2.3 12 2.3h0s-5.2 0-8.7.4c-.4.1-1.2.1-2 1C.7 4.5.5 6.2.5 6.2S0 8.2 0 10.3v1.5c0 2.1.5 4.1.5 4.1s.2 1.7.8 2.5c.8.9 1.9.9 2.4 1 1.7.2 7.3.4 7.3.4s5.2 0 8.7-.4c.4-.1 1.2-.1 2-1 .6-.8.8-2.5.8-2.5s.5-2 .5-4.1v-1.5c0-2.1-.5-4.1-.5-4.1zM9.6 14.8V8.6l6.3 3.1-6.3 3.1z" fill=\"white\" />
                                    </svg>

                                    <span>Mirar en <strong>YouTube</strong></span>
                                </div>





                            </div>



                        <?php } else { //muestra el video de youtube embebido

                            //Youtube no permite crear un iframe y pegar en el src una dirección de youtube dinamica, se debe embeber
                            $url_embebida = embeberYoutubeUrl($sv['link_video']);
                        ?>
                            <div class="tumb">
                                <iframe src="<?php echo $url_embebida ?>"
                                    frameborder="0" allowfullscreen></iframe>
                            </div>
                    </div>
                <?php } ?>

                <div class="article-content">
                    <!--Sin sanitizar  los datos para poder mostrar el texto con HTML-->
                    <p class="contenido-sv"><?php echo $sv['descripcion']; ?></p>
                </div>


            <?php else : ?>
                <!--si no existe enlace a youtube muestra el cuerpo de de la sv -->
                <div class="text-center pt-3">
                    <img src="../assets/img/sv/<?php echo sanitizar($sv['id'] . "/" . $sv['img_publicacion']); ?>" class="img-fluid" alt="imagen <?php echo $sv['titulo'] ?>">
                </div>
                <div class="article-content">
                    <!--Sin sanitizar  los datos para poder mostrar el HTML-->
                    <p class="contenido-sv"><?php echo $sv['descripcion']; ?></p>
                </div>

                <?php

                    if ($usuarioLogueado) {

                        if (!$confirme_asistencia): //si NO se encuentra registrado al evento: muestra botón de asistir al evento
                ?>
                        <div class="article-content text-center">
                            <a href="<?php echo sanitizar($sv['link_plataforma']); ?>" target="_blank" class="btn btn-primary-custom p-2 btn-evento">ACCEDER AL EVENTO AQUÍ</a>
                        </div>
                    <?php else : ?>
                        <div class="confirme">
                            <form id="confirme-asistencia">
                                <input type="hidden" name="usuarioId" value="<?php echo $_SESSION['id'] ?>" id="usuario-id">
                                <input type="hidden" name="svId" value="<?php echo sanitizar($id_sv) ?>" id="sv-id">
                                <button type="submit" class="btn btn-primary-custom p-2 btn-evento ">ASISTE AL EVENTO</button>
                            </form>
                        </div>

                    <?php endif;
                    } else { //no esta logueado, muestra el botón de registrate
                    ?>




                    <div class="continuar__leyendo">
                        <button class="btn btn-primary-custom mt-2 restringido" id="loginButtonMenu">REGISTRARSE</button>
                    </div>


                <?php } ?>




                <!-- cierra el if si no existe enlace en youtube -->
            <?php endif ?>

            </section>
        </div>
    </main>
    <?php include("../includes/banner.php"); ?>
    <?php include("../includes/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../assets/js/sv/asistirEvento.js"></script>
    <script src="../assets/js/sv/restringirSV.js"></script>



</body>

</html>