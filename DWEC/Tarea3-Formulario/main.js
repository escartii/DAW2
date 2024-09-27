// creo una variable para guardar las contraseñas antes de ser modificadas por astericos
let passwordReal = "";
let repetirPasswordReal = "";


function transformarPassword(event) {
    let inputPassword = document.getElementById("password");
    let charIngresado = String.fromCharCode(event.which || event.keyCode);

    if (charIngresado.match(/[a-zA-Z0-9@$!%*?&]/)) {
        passwordReal += charIngresado;
        inputPassword.value += "*"; 
    }

    event.preventDefault(); 
}

function transformarPasswordRepetida(event) {
    let inputRepetirPassword = document.getElementById("repetirPassword");
    let charIngresado = String.fromCharCode(event.which || event.keyCode);

    if (charIngresado.match(/[a-zA-Z0-9@$!%*?&]/)) {
        repetirPasswordReal += charIngresado;
        inputRepetirPassword.value += "*";
    }

    event.preventDefault(); 
}

function comprobarNombre() {
    let nombre = document.getElementById("nombre").value;
    return nombre !== "" && /^\p{Lu}/u.test(nombre) ? "" : "El nombre debe comenzar con mayúscula.\n";
}

function comprobarApellidos() {
    let apellidos = document.getElementById("apellidos").value;
    let palabras = apellidos.split(" ");
    return palabras.length === 2 && /^[A-Z]/.test(palabras[0]) && /^[A-Z]/.test(palabras[1]) 
        ? "" : "Los apellidos deben tener dos palabras y comenzar con mayúsculas.\n";
}

function comprobarEmail() {
    let email = document.getElementById("email").value;
    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regexCorreo.test(email) ? "" : "El correo no es válido.\n";
}

function comprobarDNI() {
    let dni = document.getElementById("DNI").value;
    let letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    let letraDNI = dni.charAt(dni.length - 1);
    let numeroDNI = parseInt(dni.substring(0, dni.length - 1));
    let letraCalculada = letras.charAt(numeroDNI % 23);
    return letraDNI === letraCalculada ? "" : "El DNI no es válido.\n";
}

function comprobarPassword() {
    let password = passwordReal;  // Aquí usamos la contraseña real
    let regexPassword = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return regexPassword.test(password) ? "" : "La contraseña no cumple los requisitos (min. 8 caracteres, 1 mayúscula, 1 número y 1 símbolo).\n";
}

function comprobarPasswordRepetida() {
    let password = passwordReal;
    let repetirPassword = repetirPasswordReal;
    return password === repetirPassword ? "" : "Las contraseñas no coinciden.\n";
}

function validarFormulario() {
    let errores = "";
    errores += comprobarNombre();
    errores += comprobarApellidos();
    errores += comprobarEmail();
    errores += comprobarDNI();
    errores += comprobarPassword();
    errores += comprobarPasswordRepetida();

    if (errores === "") {
        alert("Formulario enviado correctamente");
    } else {
        alert("Errores:\n" + errores);
    }
}