import { clubPath } from "../funciones.js";

const formAsistirEvento = document.querySelector('#confirme-asistencia');

if (formAsistirEvento) {

    formAsistirEvento.addEventListener('submit', validarFormulario);
}



function validarFormulario(e) {
    //Toma el id de la sv y el id del usuario y lo guarda en el formData
    e.preventDefault();
    const usuarioId = document.querySelector('#usuario-id').value;
    const svId = document.querySelector('#sv-id').value;
    const formData = new FormData();


    formData.append('usuarioId', usuarioId);
    formData.append('svId', svId);

    enviarConfirmacion(formData); //envia al backend
}

async function enviarConfirmacion(formData = {}) {
    //manda la confirmación de la asistencia al backend asistir al evento
    const url = `${clubPath()}/usuario/webinars/asistirEvento.php`
    const respuesta = await fetch(url, {
        method: 'POST',
        body: formData
    });
    const resultado = await respuesta.json();
    const { confirmado } = resultado;
    if (confirmado) {
        location.reload();
    }


}
