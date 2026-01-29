import { clubPath, extensionPHP } from "../funciones.js";

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
    const url = `${clubPath()}/usuario/webinars/asistirEvento${extensionPHP()}`
    const respuesta = await fetch(url, {
        method: 'POST',
        body: formData
    });
    const resultado = await respuesta.json();
    const { confirmado, nombre, fecha, titulo } = resultado;
    if (confirmado) {

        confirmacionEvento(nombre, fecha, titulo);
        // 
    }


}


function confirmacionEvento(nombre, fecha, titulo) {
    const imagen = document.querySelector('#img-publicacion').src;


    Swal.fire({
        title: "Evento confirmado",
        html: `<div class="container" style="text-align: justify;">
        <p>Estimado/a <strong>${nombre}</strong>, ha confirmado su asistencia al evento: <strong>${titulo}</strong></p>
        <p>La cita es el día <strong>${fecha}, a las 8:00 PM</strong> (horario Ciudad de México)</p> 
        <p>Recuerde que le enviaremos un recordatorio 10 minutos antes del evento vía SMS</p>
        </div>`,
        imageUrl: `${imagen}`,
        imageWidth: 250,
        imageHeight: 200,
        imageAlt: "Imagen-sesionVirtual",
        confirmButtonColor: '#f28c28',
        confirmButtonText: 'Acepto',
    }).then((result) => {
        // Aquí verificamos si presionaron el botón OK, o pico fuera del modal
        if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop) {
            //si presiono el botón de ok, recarga la página para ver que cambie el state
            location.reload();
        }

    });





}