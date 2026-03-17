import { validarCorreo, alertas, clubPath, extensionPHP } from '../funciones.js';
(function () {
    const formulario = document.querySelector('#formularioRegistro');


    formulario.addEventListener('submit', validarFormulario);


    //función que valida el formulario
    function validarFormulario(e) {
        e.preventDefault();
        const nombre = document.querySelector('#nombre').value;
        const apellidoPaterno = document.querySelector('#apellido-paterno').value;
        const apellidoMaterno = document.querySelector('#apellido-materno').value;
        const fechaNacimiento = document.querySelector('#fecha_nacimiento').value;
        const tipoUsuario = document.querySelector('#tipo_usuario');
        const nivelEstudios = document.querySelector('#nivel_estudios');
        const cedula = document.querySelector('#cedula');
        const archivo = document.querySelector('#documento');
        const codigoPostal = document.querySelector('#codigo_postal').value;
        const correo = document.querySelector('#correo').value;
        const password1 = document.querySelector('#password_1').value;
        const passwordConfirm = document.querySelector('#password_confirm').value;
        const alertasDiv = document.querySelector('#alertas');
        const terminosCondiciones = document.querySelector('#acceptTerms');


        //validaciones básicas
        if (nombre.trim() === '') {
            alertas('error', 'Error, el nombre es obligatorio....', alertasDiv);
            return;
        }
        if (apellidoPaterno.trim() === '') {
            alertas('error', 'Error, el apellido es obligatorio....', alertasDiv);
            return;
        }
        if (fechaNacimiento.trim() === '') {
            alertas('error', 'Error, selecciona tu fecha de nacimiento....', alertasDiv);
            return;
        }
        if (tipoUsuario.value.trim() === '') {
            alertas('error', 'Error, elige un tipo de usuario....', alertasDiv);
            return;
        }



        if (codigoPostal.trim() === '') {
            alertas('error', 'Error, introduce un código postal....', alertasDiv);
            return;
        }

        //validaciones avanzadas



        if (!validarCorreo(correo)) {
            alertas('error', 'Error, no es un correo valido', alertasDiv);
            return;
        }
        if (passwordConfirm.length < 6) {
            alertas('error', 'Error, el password debe ser mayor a 6 digitos', alertasDiv);
            return;
        }
        if (password1 !== passwordConfirm) {
            alertas('error', 'Error, los password no coinciden', alertasDiv);
            return;
        }
        if (!terminosCondiciones.checked) {
            alertas('error', 'Error debes aceptar los términos y condiciones', alertasDiv);
            return;
        }
        
        if(tipoUsuario.value  === 'Paciente' || tipoUsuario.value  === 'Otro' ){
            nivelEstudios.value = '';
            cedula.value='';
            archivo.value='';
        }

        if(tipoUsuario.value==='Profesional de la salud' && nivelEstudios.value==='Nivel Universitario'){
            console.log('limpiando documento....');
            
            archivo.value='';
        }
        

        if(tipoUsuario.value === 'Profesional de la salud' && nivelEstudios.value ==='Técnico' || tipoUsuario.value === 'Profesional de la salud' && nivelEstudios.value ==='Estudiante/Pasante'){
            cedula.value='';
        }


        if (tipoUsuario.value === 'Profesional de la salud' && nivelEstudios.value ==='Nivel Universitario' && cedula.value.length > 10) {
            alertas('error', 'Error, máximo 10 caracteres en cedula profesional....', alertasDiv);
            return;
        }


          


        //valida si el tipo de usuario es profesional de la salud
        if (tipoUsuario.value  === 'Profesional de la salud' && nivelEstudios.value === '') {
            alertas('error', 'Error, elige un nivel de estudios', alertasDiv);
            return;
        }

        if (nivelEstudios.value === 'Nivel Universitario' && cedula.value === '') {
            alertas('error', 'Error, introduce una cédula', alertasDiv);
            return;
        }
        if (nivelEstudios.value === 'Técnico' && !archivo.value && tipoUsuario.value ==='Profesional de la salud') {
            alertas('error', 'Error, carga un documento', alertasDiv);
            return;
        }
        if (nivelEstudios.value === 'Estudiante/Pasante' && !archivo.value && tipoUsuario.value ==='Profesional de la salud') {
            alertas('error', 'Error, carga un documento', alertasDiv);
            
            
            return;
        }

        //si todos los datos estan correctos, creamos el formData
        const formData = new FormData();
        //formdata Objeto que sirve para construir los datos de un formulario
        formData.append('nombre', nombre);
        formData.append('apellidoPaterno', apellidoPaterno);
        formData.append('apellidoMaterno', apellidoMaterno);
        formData.append('fechaNacimiento', fechaNacimiento);
        formData.append('tipoUsuario', tipoUsuario.value);
        formData.append('nivelEstudios', nivelEstudios.value);
        formData.append('cedula', cedula.value);
        formData.append('codigoPostal', codigoPostal);
        formData.append('correo', correo);
        formData.append('password1', password1);
        formData.append('passwordConfirm', passwordConfirm);
        if (archivo.value) {
            formData.append('documento', archivo.files[0]);
        }

        registrarUsuario(formData);
    }

    async function registrarUsuario(formData = {}) {
        //enviamos los datos a la url de registro
        const url = `${clubPath()}/auth/registro${extensionPHP()}`;
        const alertasDiv = document.querySelector('#alertas');
        try {
            //enviamos nuestros datos de registro por POST al backend
            const respuesta = await fetch(url, {
                method: 'POST',
                body: formData,
            });
            //backend nos responde con un json
            const resultado = await respuesta.json();

            //retorna registrado (boolean) y alertas del backend
            const { registrado, alertasBackend } = resultado
            //mostrar las alertas
            if (registrado) {
                alertas('exito', 'Exito, usuario registrado correctamente. Inicia Sesión', alertasDiv);
                setTimeout(() => {
                    showForm('loginForm', 'Iniciar sesión');
                }, 3000);
                limpiarForm();

            } else
                //si no fue exitoso iteramos sobre los mensajes del backend de validación
                if (alertasBackend.error) {
                    alertasBackend.error.forEach(mensaje => {
                        alertas('error', mensaje, alertasDiv);
                    });
                }
        } catch (error) {
            console.log(error);
        }
    }


    function showForm(formId, title) {
        // Ocultar todos los formularios
        document.querySelectorAll('.auth-form').forEach(form => {
            form.classList.remove('active');
        });

        // Mostrar el formulario seleccionado
        document.getElementById(formId).classList.add('active');

        // Actualizar título del modal
        document.getElementById('authModalLabel').textContent = title;
        
    
        /*if (authError) {
            // Ocultar mensajes de error
            authError.classList.add('d-none');
        }*/
        
    }

    function limpiarForm(){
  
        
        formulario.reset();
    }

})();