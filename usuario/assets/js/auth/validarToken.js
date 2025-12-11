import { alertas, clubPath, validarUsuario } from "../funciones.js";
(function () {
    const formulario = document.querySelector('#validar-token');
    formulario.addEventListener('submit', validarFormulario);
    const alertasDiv = document.querySelector('#token-alertas');

    const parametrosURL = new URLSearchParams(window.location.search);
    const idToken = parametrosURL.get('token');

    function validarFormulario(e) {

        e.preventDefault();
        console.log(idToken);

        const password1 = document.querySelector('#password1').value;
        const password2 = document.querySelector('#password2').value;

        const objPassword = {
            password1: password1,
            password2: password2
        }

        if (validarUsuario(objPassword)) {
            alertas('error', 'Error! Todos los campos son obligatorios', alertasDiv);
            return;
        }
        // if (password1 !== password2) {
        //     alertas('error', 'Error! Las contraseñas no coinciden', alertasDiv);
        //     return;
        // }

        if (password1.length < 6 || password2.length < 6) {
            alertas('error', 'Error! minimo 6 caracteres', alertasDiv);
            return;
        }

        validarToken(objPassword);
    }

    async function validarToken(objPassword = {}) {
        try {
            //necesitamos enviar a la url con el queryString
            const url = `${clubPath()}/auth/validarToken.php?token=${idToken}.php`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(objPassword),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const resultado = await respuesta.json();
            const { recoveryPassword, alertasBackend } = resultado;
            //si se logro validar el token
            if (recoveryPassword) {
                alertasBackend.exito.forEach(mensaje => {
                    alertas('exito', mensaje, alertasDiv);
                    setTimeout(() => {

                        window.location.href = `${clubPath()}/usuario/inicio`;
                    }, 3000);
                });
                //si no se pudo y tenemos alertas de error desde el backend
            } else if (alertasBackend.error) {
                alertasBackend.error.forEach(mensaje => {
                    alertas('error', mensaje, alertasDiv);
                })
            }
        } catch (error) {
            console.log(error);

        }


    }

})();