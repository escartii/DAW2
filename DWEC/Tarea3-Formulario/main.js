function comprobarNombre(){
    let nombre = document.getElementById("nombre");
    if (/^\p{Lu}/u.test(nombre.value)) {
        alert(`${nombre.value} empieza por Mayus`);
    } else {
        alert(`${nombre.value} no empieza por mayus`);
    }
}

function comprobarApellidos(){
    let apellidos = document.getElementById("apellidos").value;
    let palabras = apellidos.split(" ");

    if (palabras.length === 2 && /^[A-Z]/.test(palabras[0]) && /^[A-Z]/.test(palabras[1])) {
        alert("Los apellidos comienzan por mayúscula");
    } else {
        alert("Al menos una de las palabras no está en mayúsculas");
    }
}

function comprobarEmail(){
    let email = document.getElementById("email");
    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (regexCorreo.test(email.value)) {
        alert("El correo es valido")
    } else {
        alert("El correo no es valido")
    }
}

function comprobarDNI() {
    let inputdni = document.getElementById("DNI");
    let dni = inputdni.value;
    let letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    let letraDNI = dni.charAt(dni.length - 1);
    let numeroDNI = parseInt(dni.substring(0, dni.length - 1)); 
    let letraCalculada = letras.charAt(numeroDNI % 23); 

    if (letraDNI === letraCalculada) {
        alert(`${"Este DNI: " + dni + " Es válido"}`)
    } else {
        console.log("DNI inválido");
    }
}

function ponerAstericos() {
    let contrasenyaInput = document.getElementById("password");
    let contrasenya = contrasenyaInput.value;
    let asteriscos = "*".repeat(contrasenya.length);
    contrasenyaInput.value = asteriscos;
}

function comprobarPassword() {
    let password = document.getElementById("password").value;
    let regexPassword = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (regexPassword.test(password)) {
        alert("La contraseña cumple los requisitos");
    } else {
        alert("La contraseña no cumple los requisitos");
    }
}




