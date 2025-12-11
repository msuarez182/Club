(function () {
    const botones = document.querySelectorAll('.auth-nav-btn');
    const authModal = new bootstrap.Modal(document.getElementById('authModal'));

    botones.forEach(boton => {
        boton.addEventListener('click', mostrarModal);
    });

    function mostrarModal() {

        authModal.show();
    }
    // Función para configurar el toggle de visibilidad de contraseña
    function mostrarPassword(toggleId, passwordFieldId) {
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
    mostrarPassword('passwordToggle1', 'password1');
    mostrarPassword('passwordToggle2', 'password2');

    // Cerrar modal al hacer clic fuera de él
    //De esta forma no se encima modal sobre modal
    document.getElementById('authModal').addEventListener('click', function (e) {
        if (e.target === this) {
            authModal.hide();
        }
    });


})();