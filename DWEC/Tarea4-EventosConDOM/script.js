// Añado un listener que escucha el 'click', cuando se produce click sobre el elemento copiarBtn
// me guardo el valor de las variables que contiene el formulario.
document.getElementById('copiarBtn').addEventListener('click', function () {

    function comprobarDNI() {
        let dni = document.getElementById("dni").value;
        let letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        let letraDNI = dni.charAt(dni.length - 1);
        let numeroDNI = parseInt(dni.substring(0, dni.length - 1));
        let letraCalculada = letras.charAt(numeroDNI % 23);
        return letraDNI === letraCalculada ? true : false;
    }

    function comprobarEmail() {
        let email = document.getElementById("email").value;
        let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regexCorreo.test(email) ? true : false;
    }

    function comprobarNombre() {
        let nombre = document.getElementById("nombre").value;
        return nombre !== "" && /^\p{Lu}/u.test(nombre) ? true : false;
    }

    // Variables que guardo el resultado de los valores de las funcciones (boolean)
    let letraDNI = comprobarDNI();
    let regexCorreo = comprobarEmail();
    let nombre = comprobarNombre();

    if (letraDNI === true && regexCorreo === true && nombre === true) {
        const nombre = document.getElementById('nombre').value;
        const DNI = document.getElementById('dni').value;
        const email = document.getElementById('email').value;

        // Creo un nuevo div y le añado el texto concatenado con las variables
        const nuevoDiv = document.createElement('div');
        nuevoDiv.textContent = `${nombre} con DNI ${DNI} y e-mail ${email}`;
        document.getElementById('listado').appendChild(nuevoDiv);

        // Borrar el contenido del Fomrulario
        document.getElementById('miFormulario').reset();
    } else if (letraDNI === false) {
        alert("El DNI no es válido o el campo está vacío");
    } else if (regexCorreo === false) {
        alert("El correo no es válido o el campo está vacío");
    } else if (nombre === false) {
        alert("El nombre debe comenzar con mayúscula");
    }
});