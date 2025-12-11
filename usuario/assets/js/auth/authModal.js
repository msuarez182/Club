import { clubPath } from "../funciones.js";
(function () {
    const menuToggle = document.querySelector('#menuToggle'); //funcionalidad del botón de hamburguesa
    const authModal = new bootstrap.Modal(document.querySelector('#authModal'));//Modal de Auth general, instancia
    const btnLogout = document.querySelector('#logoutBtn');//botón de cerrar sesión (solo si esta logueado)





    document.addEventListener('DOMContentLoaded', function () {
        comprobarLogin();
    });

    /*Funcionalidades basicas del boton hamburgueza y modalAuth*/

    // funcionalidad del botón de hamburguesa
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        dropdownMenu.classList.toggle('show');
        menuOverlay.classList.toggle('show');
        document.body.classList.toggle('menu-open');
    });

    /*lógica del authModal*/

    // Botón de login dentro del menú hamburguesa
    const btnAuth = document.querySelector('#loginButtonMenu');
    if (btnAuth) {
        btnAuth.addEventListener('click', () => {
            closeMenu();
            // showForm('loginForm', 'Iniciar Sesión');
            authModal.show();
        });
    }


    //cierra todo el modalAuth y el contenido del menú hamburguesa
    function closeMenu() {
        menuToggle.classList.remove('active');
        dropdownMenu.classList.remove('show');
        menuOverlay.classList.remove('show');
        document.body.classList.remove('menu-open');
    }
    //Cierra el modal del menú hamburguesa, al clicar afuera.
    menuOverlay.addEventListener('click', closeMenu);




    /* Funcionalidades avanzadas del authModal */

    //navegación entre formularios del modal, por medio de los botones inferiores
    const mostrarRecoveryPassword = document.querySelector('#showRecovery')
    mostrarRecoveryPassword.addEventListener('click', () => {
        showForm('#recoveryForm', 'Recuperar Contraseña');
    });

    const mostrarRegistro = document.querySelector('#showRegister')
    mostrarRegistro.addEventListener('click', () => {
        showForm('#formularioRegistro', 'Registrarse');
    });
    const regresarRecoveryPassword = document.querySelector('#backToLoginFromRecovery')
    regresarRecoveryPassword.addEventListener('click', () => {
        showForm('#loginForm', 'Iniciar Sesión');
    });

    const regresarRegistro = document.querySelector('#backToLoginFromRegister')
    regresarRegistro.addEventListener('click', () => {
        showForm('#loginForm', 'Iniciar Sesión');
    });

    //función que muestra el formulario segun el botón presionado.
    function showForm(formId, title) {
        // Ocultar todos los formularios
        document.querySelectorAll('.auth-form').forEach(form => {
            form.classList.remove('active');
        });

        // Mostrar el formulario seleccionado
        document.querySelector(formId).classList.add('active');

        // Actualizar título del modal
        document.querySelector('#authModalLabel').textContent = title;
    }

    //muestra el password al precionar el ojito
    function mostrarPassword(toggleId, passwordFieldId) {
        const ojitoPassword = document.getElementById(toggleId);
        const passwordInput = document.getElementById(passwordFieldId);

        if (ojitoPassword && passwordInput) {
            ojitoPassword.addEventListener('click', () => {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    ojitoPassword.innerHTML = '<i class="far fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    ojitoPassword.innerHTML = '<i class="far fa-eye"></i>';
                }
            });
        }
    }

    //toma el id del toggle de ojito y el id del input type password
    mostrarPassword('passwordToggle', 'password-login');
    mostrarPassword('registerPasswordToggle', 'password_1');
    mostrarPassword('registerConfirmPasswordToggle', 'password_confirm');


    //formulario dinamico de tipo de usuario y especialidades
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
            if (nivelEstudios.value === 'Nivel Universitario') {
                campoCedula.style.display = 'block';
                campoDocumento.style.display = 'none';
            } else
                if (nivelEstudios.value !== 'Nivel Universitario') {
                    campoCedula.style.display = 'none';
                    campoDocumento.style.display = 'block';
                }

        });

    }
    //se autoejecuta
    camposDinamicos();


    //cerrando sesión
    if (btnLogout) {
        btnLogout.addEventListener('click', cerrarSesion);
    }
    //cerrando sesión
    function cerrarSesion(e) {
        e.preventDefault();
        window.location.href = `${clubPath()}/auth/logout.php`;
    }

    /* INICIO DE SESIÓN Y CONTENIDO DINAMICO */
    function comprobarLogin() {

        /* Busca en el Local Storage si el usuario esta logueado o no*/
        const usuarioLogueado = localStorage.getItem('usuarioLogueado');

        //si no es true, pide que se logue
        if (usuarioLogueado !== 'true') {
            authModal.show();
        }
    }

    //popOver de registro
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));


})();
