(function () {



    document.addEventListener('DOMContentLoaded', function () {

        //cerrar el video
        const btnCerrar = document.querySelector('#cerrar-video');
        btnCerrar.addEventListener('click', cerrarModal);

        function cerrarModal() {
            const modal = bootstrap.Modal.getInstance(videoModal) || new bootstrap.Modal(videoModal);            
            modal.hide();
        }


        // Restablecer filtros
        document.getElementById('reset-filters').addEventListener('click', function () {
            window.location.href = window.location.pathname;
        });

        // Actualizar el campo oculto de página cuando se aplican filtros
        document.getElementById('filter-form').addEventListener('submit', function () {
            document.getElementById('pagina-hidden').value = 1;
        });

        // Configurar modal para videos
        var videoModal = document.getElementById('videoModal');
        if (videoModal) {
            videoModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                var videoSrc = button.getAttribute('data-video-src');
                document.getElementById('videoFrame').src = videoSrc;
            });
            videoModal.addEventListener('hide.bs.modal', function () {
                document.getElementById('videoFrame').src = '';
            });
        }

        // Hacer clic en toda la miniatura
        document.querySelectorAll('.video-thumbnail').forEach(function (thumbnail) {
            thumbnail.addEventListener('click', function (e) {
                if (!e.target.closest('.play-icon')) {
                    var playIcon = this.querySelector('.play-icon');
                    if (playIcon) {
                        const modal = bootstrap.Modal.getInstance(videoModal) || new bootstrap.Modal(videoModal);
                        var videoSrc = playIcon.getAttribute('data-video-src');
                        document.getElementById('videoFrame').src = videoSrc;
                        modal.show();
                    }
                }
            });
        });

        // Hacer clic en miniaturas de la sección "También te puede interesar"
        document.querySelectorAll('.recommended-thumbnail').forEach(function (thumbnail) {
            thumbnail.addEventListener('click', function (e) {
                if (!e.target.closest('.play-icon')) {
                    var playIcon = this.querySelector('.play-icon');
                    if (playIcon) {
                        var modal = bootstrap.Modal.getInstance(videoModal) || new bootstrap.Modal(videoModal);
                        var videoSrc = playIcon.getAttribute('data-video-src');
                        document.getElementById('videoFrame').src = videoSrc;
                        modal.show();
                    }
                }
            });
        });


    });


})();  