document.getElementById('copiarBtn').addEventListener('click', function () {
    // Validaciones
    let letraDNI = comprobarDNI();
    let regexCorreo = comprobarEmail();
    let nombre = comprobarNombre();

    if (letraDNI && regexCorreo && nombre) {
        const nombre = document.getElementById('nombre').value;
        const DNI = document.getElementById('dni').value;
        const email = document.getElementById('email').value;
        const list = document.getElementById('lista').value;


        // Crear un nuevo div
        const nuevoDiv = document.createElement('div');
        nuevoDiv.textContent = `${nombre} con DNI ${DNI} y e-mail ${email}`;
        nuevoDiv.setAttribute('data-nombre', nombre); // Para usar más tarde en el reemplazo
        document.getElementById('listado-'+list).appendChild(nuevoDiv);

        // Borrar el contenido del formulario
        document.getElementById('miFormulario').reset();
    } else {
        if (!letraDNI) alert("El DNI no es válido o el campo está vacío");
        if (!regexCorreo) alert("El correo no es válido o el campo está vacío");
        if (!nombre) alert("El nombre debe comenzar con mayúscula");
    }
});

function comprobarDNI() {
    let dni = document.getElementById("dni").value;
    let letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    let letraDNI = dni.charAt(dni.length - 1);
    let numeroDNI = parseInt(dni.substring(0, dni.length - 1));
    let letraCalculada = letras.charAt(numeroDNI % 23);
    return letraDNI === letraCalculada;
}

function comprobarEmail() {
    let email = document.getElementById("email").value;
    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regexCorreo.test(email);
}

function comprobarNombre() {
    let nombre = document.getElementById("nombre").value;
    return nombre !== "" && /^\p{Lu}/u.test(nombre);
}