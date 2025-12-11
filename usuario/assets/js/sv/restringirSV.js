(function () {
    // Agregar event listeners a todos los elementos que requieres que este logueado para acceder a ellos
    const areaRestringida = document.querySelectorAll('.restringido');
    console.log(areaRestringida);
    const usuarioLogueado = localStorage.getItem('usuarioLogueado');
    areaRestringida.forEach(link => {
        link.addEventListener('click', e => {
            if (usuarioLogueado !== 'true') {
                e.preventDefault();
                comprobarLogin();
            }

        });
    });


    function showForm(formId, title) {
        // Ocultar todos los formularios
        document.querySelectorAll('.auth-form').forEach(form => {
            form.classList.remove('active');
        });

        // Mostrar el formulario seleccionado
        document.getElementById(formId).classList.add('active');

        // Actualizar título del modal
        document.getElementById('authModalLabel').textContent = title;

        // Ocultar mensajes de error
        authError.classList.add('d-none');
    }

    function comprobarLogin() {
        /* Busca en el Local Storage si el usuario esta logueado o no*/
        //si no es true, pide que se logue

        if (usuarioLogueado !== 'true') {
            mostrarModal();
        }
    }

    function mostrarModal() {
        let authModal = new bootstrap.Modal(document.querySelector('#authModal'));//Modal de Auth general, instancia
        authModal.show();
        authModal = document.querySelector('#loginForm');
        authModal.classList.remove('active');
        

        authModal = document.querySelector('#formularioRegistro');
        authModal.classList.add('active');
        const titulo=document.querySelector('#authModalLabel');
        titulo.textContent='Registro';
        console.log(authModal.authModalLabel);

    }







})();
