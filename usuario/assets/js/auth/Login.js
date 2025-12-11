import { validarCorreo, alertas, validarUsuario, clubPath } from "../funciones.js";
(function () {
    const formularioLogin = document.querySelector('#loginForm');
    const alertasLogin = document.querySelector('#alertas-login');
    //deeplink
    formularioLogin.addEventListener('submit', validarLogin);
    //declaramos nuestro objeto de login
    function validarLogin(e) {
        e.preventDefault();
        const correo = document.querySelector('#email-login').value;
        const password = document.querySelector('#password-login').value;
        const loginObj = { correo, password }

        if (validarUsuario(loginObj)) {
            alertas('error', 'Error, todos los campos son obligatorios....', alertasLogin);
            return;
        }
        if (!validarCorreo(correo)) {
            alertas('error', 'Error, no es un correo valido', alertasLogin);
            return;
        }

        //pasando las validaciones básicas lo mandamos al backend el objeto
        loginUsuario(loginObj);
    }
    async function loginUsuario(objeto = {}) {
        const url = `${clubPath()}/auth/login.php`;
        try {
            const respuesta = await fetch(url, {
                method: 'POST',
                body: JSON.stringify(objeto),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            const resultado = await respuesta.json();
            const { usuarioLogueado, alertasBackend } = resultado;
            if (usuarioLogueado) {
                location.reload();//solo recarga pagina, no redirecciona para no perder link
            } else {
                alertasBackend.error.forEach(mensaje => {
                    alertas('error', mensaje, alertasLogin);
                });
            }


        } catch (error) {
            console.log(error);

        }

    }
})();