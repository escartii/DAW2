// Mensajes de los resultados de las jugadas
var mensajes = {
    tipa: "Tijeras cortan papel",
    papi: "Papel tapa piedra",
    pila: "Piedra aplasta lagarto",
    lasp: "Lagarto envenena a Spock",
    spti: "Spock rompe tijeras",
    tila: "Tijeras decapitan lagarto",
    lapa: "Lagarto devora papel",
    pasp: "Papel desautoriza a Spock",
    sppi: "Spock vaporiza piedra",
    piti: "Piedra aplasta tijeras"
};

// Reglas del juego (clave: ganador, valor: [perdedor, mensaje])
const reglas = {
    tijeras: [
        { pierde: "papel", mensaje: "tipa" },
        { pierde: "lagarto", mensaje: "tila" }
    ],
    papel: [
        { pierde: "piedra", mensaje: "papi" },
        { pierde: "spock", mensaje: "pasp" }
    ],
    piedra: [
        { pierde: "tijeras", mensaje: "piti" },
        { pierde: "lagarto", mensaje: "pila" }
    ],
    lagarto: [
        { pierde: "spock", mensaje: "lasp" },
        { pierde: "papel", mensaje: "lapa" }
    ],
    spock: [
        { pierde: "tijeras", mensaje: "spti" },
        { pierde: "piedra", mensaje: "sppi" }
    ]
};

// Variables globales
let puntosUsuario = 0;
let puntosBot = 0;
let eleccionUsuario;
let eleccionBot;

window.onload = () => {
    asignarElementosHTML();
    cargarEventos();
};

// Asignar elementos del DOM a variables
function asignarElementosHTML() {
    this.dropzone = document.getElementById("seleccionado");
    this.veredicto = document.getElementById("veredicto");
    this.btnContinuar = document.getElementById("continuar");
}

// Cargar eventos de arrastre y soltar
function cargarEventos() {
    const items = document.querySelectorAll(".item");

    for (const item of items) {
        item.addEventListener("dragstart", (event) => {
            event.dataTransfer.setData("text/plain", event.target.id);
        });
    }

    dropzone.addEventListener("dragover", (event) => event.preventDefault());
    dropzone.addEventListener("drop", manejarDrop);

    btnContinuar.addEventListener("click", reiniciarJuego);
}

// Manejar el evento de soltar un elemento
function manejarDrop(event) {
    event.preventDefault();
    const id = event.dataTransfer.getData("text/plain");
    const elemento = document.getElementById(id);

    eleccionUsuario = id; // Guardar la elección del usuario
    dropzone.innerHTML = ""; // Limpiar el área de selección
    dropzone.appendChild(elemento.cloneNode(true)); // Clonar y mostrar el elemento

    turnoBot(); // Iniciar el turno del bot
}

// Simular la elección del bot
function turnoBot() {
    const opciones = ["piedra", "papel", "tijeras", "lagarto", "spock"];
    eleccionBot = opciones[Math.floor(Math.random() * opciones.length)];

    // Mostrar la elección del bot en el área correspondiente
    const enemigo = document.getElementById("enemigo");
    enemigo.innerHTML = `<img src="img/${eleccionBot}.png" alt="${eleccionBot}">`;

    calcularResultado(); // Evaluar el resultado del turno
}

// Calcular el resultado del turno
function calcularResultado() {
    if (eleccionUsuario === eleccionBot) {
        mostrarMensaje("¡Empate!", `Ambos eligieron ${eleccionUsuario}.`);
    } else {
        const resultado = verificarGanador(eleccionUsuario, eleccionBot);
        if (resultado.ganador === "usuario") {
            puntosUsuario++;
            mostrarMensaje("¡Ganaste!", mensajes[resultado.mensaje]);
        } else {
            puntosBot++;
            mostrarMensaje("¡Perdiste!", mensajes[resultado.mensaje]);
        }
    }

    actualizarMarcador();
}

// Verificar ganador según las reglas
function verificarGanador(usuario, bot) {
    const reglasUsuario = reglas[usuario];
    for (let regla of reglasUsuario) {
        if (regla.pierde === bot) {
            return { ganador: "usuario", mensaje: regla.mensaje };
        }
    }
    return { ganador: "bot", mensaje: reglas[bot].find(r => r.pierde === usuario).mensaje };
}

// Mostrar mensaje del resultado
function mostrarMensaje(titulo, detalle) {
    const mensaje = document.getElementById("mensaje");
    mensaje.querySelector("p").innerText = `${titulo} ${detalle}`;
    mensaje.className = "visible";
    document.getElementById("proteccion").className = "visible";
}

// Actualizar marcador en la interfaz
function actualizarMarcador() {
    document.getElementById("puntosUsuario").innerText = puntosUsuario;
    document.getElementById("puntosBot").innerText = puntosBot;
}

// Reiniciar el tablero para el siguiente turno
function reiniciarJuego() {
    document.getElementById("mensaje").className = "invisible";
    document.getElementById("proteccion").className = "invisible";
    dropzone.innerHTML = ""; // Limpiar selección
    document.getElementById("enemigo").innerHTML = ""; // Limpiar elección del bot
}
