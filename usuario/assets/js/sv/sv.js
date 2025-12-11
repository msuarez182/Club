import { clubPath, slugify } from ".././funciones.js";

(function () {

    document.addEventListener('DOMContentLoaded', () => {
        listarSV();
    });
    const cards = document.querySelector('#sesiones-virtuales');


    async function listarSV() {
    
        //traemos todas las sv desde la bd
        const url = `${clubPath()}/usuario/webinars/listarSV.php`;
        try {
            const respuesta = await fetch(url);
            const datos = await respuesta.json();

            //recorremos el arreglo para mostrar el html
            datos.forEach(sesionesVirtuales => {
                const { id, titulo, descripcion, img_publicacion, img_confirme, fecha, link_plataforma, link_video, status } = sesionesVirtuales;
                
                const divCard=document.createElement('DIV');
                divCard.classList.add('col-md-4');

                const card= document.createElement('DIV');
                card.classList.add('card','h-100', 'shadow-sm','border-0');

                const cardImg=document.createElement('IMG');
                cardImg.src=`../assets/img/sv/${id}/${img_publicacion}`;
                cardImg.alt=`Imagen: ${titulo}`;
                cardImg.classList.add('card-img-top', 'pointer');


                const cardBody=document.createElement('DIV');
                cardBody.classList.add('card-body');

                const link=document.createElement('A');
                link.href=`sesionVirtual.php?id=${id}&sv=${slugify(titulo)}`;
                link.classList.add('text-decoration-none');

                const tituloSV=document.createElement('P');
                tituloSV.classList.add('card-title', 'fs-5');
                // tituloSV.href=`sesionVirtual.php?id=${id}&sv=${slugify(titulo)}`;
                tituloSV.textContent=`${titulo}`;

                const fechaEvento=document.createElement('P');
                fechaEvento.classList.add('fw-bold','pt-2');
                fechaEvento.textContent=`${fecha} 8:00 PM`;


                const divFooter=document.createElement('DIV');
                divFooter.classList.add('card-footer', 'bg-transparent', 'border-0');
                
                cardBody.appendChild(tituloSV);
                // cardBody.appendChild(fechaEvento);
                
                
                card.appendChild(cardImg);
                card.appendChild(cardBody);
                link.appendChild(card);

                divCard.appendChild(link);
                

                 cards.appendChild(divCard);
                

            });


        } catch (error) {
            console.log(error);

        }
    }

})();