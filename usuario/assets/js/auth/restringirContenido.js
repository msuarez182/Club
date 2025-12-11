(function () {
    // Agregar event listeners a todos los elementos que requieres que este logueado para acceder a ellos
    const areaRestringida = document.querySelectorAll('.restringido');
    const usuarioLogueado = localStorage.getItem('usuarioLogueado');
    areaRestringida.forEach(link => {
        link.addEventListener('click', e => {
            if (usuarioLogueado !== 'true') {
                e.preventDefault();
                comprobarLogin();
            }

        });
    });
    function comprobarLogin() {
        const authModal = new bootstrap.Modal(document.querySelector('#authModal'));//Modal de Auth general, instancia
        /* Busca en el Local Storage si el usuario esta logueado o no*/
        //si no es true, pide que se logue
        if (usuarioLogueado !== 'true') {
            authModal.show();
        }
    }


    
})();
