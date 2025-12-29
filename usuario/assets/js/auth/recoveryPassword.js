import { alertas, clubPath, validarCorreo, mostrarSpinner, extensionPHP } from "../funciones.js";

(function () {

    const formularioRecovery = document.querySelector('#recoveryForm');
    const alertasRecovery = document.querySelector('#alertas-recovery');
    formularioRecovery.addEventListener('submit', validarFormulario);

    function validarFormulario(e) {
        e.preventDefault();
        const correo = document.querySelector('#recoveryEmail').value;


        if (correo === '') {
            alertas('error', 'Error, introduce un email registrado', alertasRecovery);
            return;
        };
        if (!validarCorreo(correo)) {
            alertas('error', 'Error, no es un email válido', alertasRecovery);
            return;
        }

        //pasando las validaciones básicas lo mandamos al backend el objeto
        recoveryUsuario(correo);
    }

    async function recoveryUsuario(correo) {
        //buscamos el boton de enviar
        const btnSubmit = document.querySelector('#recoveryForm button[type="submit"]');
        //desactivamos el botón
        btnSubmit.classList.add('disabled');
        const url = `${clubPath()}/auth/recoveryPassword${extensionPHP()}`;

        try {
            mostrarSpinner(alertasRecovery);
            const respuesta = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(correo),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const resultado = await respuesta.json();
            const { recoveryPassword, alertasBackend } = resultado;
            if (recoveryPassword) {
                alertasBackend.exito.forEach(mensaje => {
                    alertas('exito', mensaje, alertasRecovery);
                    //activamos el botón de nuevo
                    btnSubmit.classList.remove('disabled');
                });
            } else {
                alertasBackend.error.forEach(mensaje => {
                    alertas('error', mensaje, alertasRecovery);
                    btnSubmit.classList.remove('disabled');

                });
            }
        } catch (error) {
            console.log(error);

        }

    }



})();