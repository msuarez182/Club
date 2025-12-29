function validarUsuario(obj) {
    return !Object.values(obj).every(input => input !== '')
}

function validarCorreo(correo) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(correo);
}

function alertas(tipo, mensaje, referencia) {
    limpiarHTML(referencia);
    const alertas = document.querySelector('.alertas');
    if (!alertas) {
        const alerta = document.createElement('DIV');
        alerta.classList.add('text-center', 'text-sm');
        if (tipo === 'error') {
            alerta.classList.add('text-white', 'alertas', 'error-message', 'fw-bold', 'bg-danger', 'p-2');
        } else {
            alerta.classList.add('text-white', 'alertas', 'fw-bold', 'bg-success', 'p-2');
        }
        alerta.textContent = mensaje;
        referencia.appendChild(alerta);
        //eliminamos alerta despues de 3seg
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}

function limpiarHTML(referencia) {
    while (referencia.firstChild) {
        referencia.removeChild(referencia.firstChild);
    }
}

function clubPath() {
    //`http://localhost/club`
    return `http://localhost/club`;
}

function mostrarSpinner(referencia) {
    const divSpinner = document.createElement('DIV');
    divSpinner.classList.add('sk-circle');
    divSpinner.innerHTML = `
    <div class="sk-circle1 sk-child"></div>
    <div class="sk-circle2 sk-child"></div>
    <div class="sk-circle3 sk-child"></div>
    <div class="sk-circle4 sk-child"></div>
    <div class="sk-circle5 sk-child"></div>
    <div class="sk-circle6 sk-child"></div>
    <div class="sk-circle7 sk-child"></div>
    <div class="sk-circle8 sk-child"></div>
    <div class="sk-circle9 sk-child"></div>
    <div class="sk-circle10 sk-child"></div>
    <div class="sk-circle11 sk-child"></div>
    <div class="sk-circle12 sk-child"></div>
    `;
    referencia.appendChild(divSpinner);
}

function slugify(texto) {
    return texto.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)+/g, '');
}

function extensionPHP() {
    return '.php';
}


export {
    validarUsuario,
    validarCorreo,
    alertas,
    limpiarHTML,
    clubPath,
    mostrarSpinner,
    slugify,
    extensionPHP
}