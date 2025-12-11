 // Elementos del DOM

    const btnLogout = document.querySelector('#logoutBtn');//botón de cerrar sesión (solo si esta logueado)

    //formulario dinamico
    function camposDinamicos() {
        //solo campo de estudios
        const campoEstudios = document.querySelector('#estudios');
        //select del campo de estudios
        const nivelEstudios = document.querySelector('#nivel_estudios');
        const campoCedula = document.querySelector('#cedula-profesional');
        const campoDocumento = document.querySelector('#document');
        const tipoUsuario = document.querySelector('#tipo_usuario');

        //ocultando entradas
        campoDocumento.style.display = 'none';
        campoCedula.style.display = 'none';
        campoEstudios.style.display = 'none';

        tipoUsuario.addEventListener('change', (e) => {

            if (tipoUsuario.value === 'Profesional de la salud') {
                campoEstudios.style.display = 'block';
            } else {
                campoEstudios.style.display = 'none';
                campoDocumento.style.display = 'none';
                campoCedula.style.display = 'none';
            }
        });


        nivelEstudios.addEventListener('change', (e) => {
            if (nivelEstudios.value === 'Licenciatura') {
                campoCedula.style.display = 'block';
                campoDocumento.style.display = 'none';
            } else
            if (nivelEstudios.value !== 'Licenciatura') {
                campoCedula.style.display = 'none';
                campoDocumento.style.display = 'block';
            }

        });

    }
    camposDinamicos();

    //cerrar sesión 
    if (btnLogout) {
        btnLogout.addEventListener('click', cerrarSesion);
    }




    // Toggle menú
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        dropdownMenu.classList.toggle('show');
        menuOverlay.classList.toggle('show');
        document.body.classList.toggle('menu-open');
    });

    menuOverlay.addEventListener('click', closeMenu);

    // Función para configurar el toggle de visibilidad de contraseña
    function setupPasswordToggle(toggleId, passwordFieldId) {
        const toggle = document.getElementById(toggleId);
        const passwordField = document.getElementById(passwordFieldId);

        if (toggle && passwordField) {
            toggle.addEventListener('click', () => {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggle.innerHTML = '<i class="far fa-eye-slash"></i>';
                } else {
                    passwordField.type = 'password';
                    toggle.innerHTML = '<i class="far fa-eye"></i>';
                }
            });
        }
    }

    // Configurar todos los toggles de contraseña
    setupPasswordToggle('passwordToggle', 'password-login');
    setupPasswordToggle('registerPasswordToggle', 'password_1');
    setupPasswordToggle('registerConfirmPasswordToggle', 'password_confirm');

    // Navegación entre formularios del modal
    document.getElementById('showRecovery')?.addEventListener('click', () => {
        showForm('recoveryForm', 'Recuperar Contraseña');
    });

    document.getElementById('showRegister')?.addEventListener('click', () => {
        showForm('formularioRegistro', 'Registrarse');
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

    function closeMenu() {
        menuToggle.classList.remove('active');
        dropdownMenu.classList.remove('show');
        menuOverlay.classList.remove('show');
        document.body.classList.remove('menu-open');
    }


    // Cerrar modal al hacer clic fuera de él
    document.getElementById('authModal').addEventListener('click', function(e) {
        if (e.target === this) {
            authModal.hide();
        }
    });

    //cerrando sesión
  

    document.getElementById('backToLoginFromRecovery')?.addEventListener('click', () => {
        showForm('loginForm', 'Iniciar Sesión');
    });

    document.getElementById('backToLoginFromRegister')?.addEventListener('click', () => {
        showForm('loginForm', 'Iniciar Sesión');
    });
    // Botón de login en el menú
    document.getElementById('loginButtonMenu')?.addEventListener('click', () => {
        closeMenu();
        showForm('loginForm', 'Iniciar Sesión');
        authModal.show();
    });

    // Función para manejar clics en enlaces del menú
    function handleMenuClick(e) {
        if (!usuarioLogueado) {
            e.preventDefault();
            closeMenu();
            showForm('loginForm', 'Iniciar Sesión');
            authModal.show();
        }
    }
    // Manejo de envío de formularios
    loginForm.addEventListener('submit', function(e) {
        // El formulario se envía normalmente por POST
        authError.classList.add('d-none');
    });
    // Agregar event listeners a todos los enlaces del menú
    document.querySelectorAll('.menu-link, .social-link, #logoLink').forEach(link => {
        link.addEventListener('click', handleMenuClick);
    });