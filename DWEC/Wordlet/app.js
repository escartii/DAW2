const campeones = [
    { name: "Aatrox", role: "Luchador, AD" },
    { name: "Ahri", role: "Maga, AP" },
    { name: "Akali", role: "Asesina, AP" },
    { name: "Akshan", role: "Tirador, AD" },
    { name: "Alistar", role: "Soporte/Tanque, AP" },
    { name: "Amumu", role: "Tanque/Mago, AP" },
    { name: "Anivia", role: "Maga, AP" },
    { name: "Annie", role: "Maga, AP" },
    { name: "Aphelios", role: "Tirador, AD" },
    { name: "Ashe", role: "Tiradora, AD" },
    { name: "Aurelion Sol", role: "Mago, AP" },
    { name: "Azir", role: "Mago, AP" },
    { name: "Bardo", role: "Soporte, AP" },
    { name: "Bel'Veth", role: "Luchadora, AD" },
    { name: "Blitzcrank", role: "Soporte/Tanque, AD" },
    { name: "Brand", role: "Mago, AP" },
    { name: "Braum", role: "Soporte/Tanque, AD" },
    { name: "Caitlyn", role: "Tiradora, AD" },
    { name: "Camille", role: "Luchadora, AD" },
    { name: "Cassiopeia", role: "Maga, AP" },
    { name: "Cho'Gath", role: "Tanque/Mago, AP" },
    { name: "Corki", role: "Tirador, AD/AP" },
    { name: "Darius", role: "Luchador, AD" },
    { name: "Diana", role: "Asesina/Maga, AP" },
    { name: "Dr. Mundo", role: "Tanque, AD" },
    { name: "Draven", role: "Tirador, AD" },
    { name: "Ekko", role: "Asesino/Mago, AP" },
    { name: "Elise", role: "Maga/Luchadora, AP" },
    { name: "Evelynn", role: "Asesina, AP" },
    { name: "Ezreal", role: "Tirador, AD/AP" },
    { name: "Fiddlesticks", role: "Mago, AP" },
    { name: "Fiora", role: "Luchadora, AD" },
    { name: "Fizz", role: "Asesino, AP" },
    { name: "Galio", role: "Tanque/Mago, AP" },
    { name: "Gangplank", role: "Luchador/Tirador, AD" },
    { name: "Garen", role: "Tanque/Luchador, AD" },
    { name: "Gnar", role: "Luchador/Tanque, AD" },
    { name: "Gragas", role: "Tanque/Mago, AP" },
    { name: "Graves", role: "Tirador, AD" },
    { name: "Gwen", role: "Luchadora, AP" },
    { name: "Hecarim", role: "Luchador/Tanque, AD" },
    { name: "Heimerdinger", role: "Mago, AP" },
    { name: "Illaoi", role: "Luchadora, AD" },
    { name: "Irelia", role: "Luchadora, AD" },
    { name: "Ivern", role: "Soporte/Mago, AP" },
    { name: "Janna", role: "Soporte, AP" },
    { name: "Jarvan IV", role: "Luchador/Tanque, AD" },
    { name: "Jax", role: "Luchador, AD" },
    { name: "Jayce", role: "Luchador/Tirador, AD" },
    { name: "Jhin", role: "Tirador, AD" },
    { name: "Jinx", role: "Tiradora, AD" },
    { name: "K'Sante", role: "Tanque/Luchador, AD" },
    { name: "Kai'Sa", role: "Tiradora, AD/AP" },
    { name: "Kalista", role: "Tiradora, AD" },
    { name: "Karma", role: "Maga/Soporte, AP" },
    { name: "Karthus", role: "Mago, AP" },
    { name: "Kassadin", role: "Asesino/Mago, AP" },
    { name: "Katarina", role: "Asesina, AP" },
    { name: "Kayle", role: "Luchadora/Maga, AP/AD" },
    { name: "Kayn", role: "Asesino/Luchador, AD" },
    { name: "Kennen", role: "Mago/Luchador, AP" },
    { name: "Kha'Zix", role: "Asesino, AD" },
    { name: "Kindred", role: "Tirador, AD" },
    { name: "Kled", role: "Luchador/Tanque, AD" },
    { name: "Kog'Maw", role: "Tirador, AD/AP" },
    { name: "LeBlanc", role: "Asesina/Maga, AP" },
    { name: "Lee Sin", role: "Luchador, AD" },
    { name: "Leona", role: "Soporte/Tanque, AD" },
    { name: "Lillia", role: "Luchadora, AP" },
    { name: "Lissandra", role: "Maga, AP" },
    { name: "Lucian", role: "Tirador, AD" },
    { name: "Lulu", role: "Soporte, AP" },
    { name: "Lux", role: "Maga/Soporte, AP" },
    { name: "Malphite", role: "Tanque/Mago, AP" },
    { name: "Malzahar", role: "Mago, AP" },
    { name: "Maokai", role: "Tanque, AP" },
    { name: "Master Yi", role: "Asesino/Luchador, AD" },
    { name: "Milio", role: "Soporte, AP" },
    { name: "Miss Fortune", role: "Tiradora, AD" },
    { name: "Mordekaiser", role: "Luchador/Mago, AP" },
    { name: "Morgana", role: "Maga/Soporte, AP" },
    { name: "Nami", role: "Soporte, AP" },
    { name: "Nasus", role: "Luchador/Tanque, AD" },
    { name: "Nautilus", role: "Soporte/Tanque, AP" },
    { name: "Neeko", role: "Maga, AP" },
    { name: "Nidalee", role: "Asesina/Maga, AP" },
    { name: "Nilah", role: "Tiradora, AD" },
    { name: "Nocturne", role: "Asesino/Luchador, AD" },
    { name: "Nunu y Willump", role: "Tanque/Mago, AP" },
    { name: "Olaf", role: "Luchador, AD" },
    { name: "Orianna", role: "Maga, AP" },
    { name: "Ornn", role: "Tanque, AD" },
    { name: "Pantheon", role: "Luchador, AD" },
    { name: "Poppy", role: "Tanque/Luchadora, AD" },
    { name: "Pyke", role: "Asesino/Soporte, AD" },
    { name: "Qiyana", role: "Asesina, AD" },
    { name: "Quinn", role: "Tiradora, AD" },
    { name: "Rakan", role: "Soporte, AP" },
    { name: "Rammus", role: "Tanque, AD" },
    { name: "Rek'Sai", role: "Luchador, AD" },
    { name: "Rell", role: "Soporte/Tanque, AP" },
    { name: "Renata Glasc", role: "Soporte, AP" },
    { name: "Renekton", role: "Luchador, AD" },
    { name: "Rengar", role: "Asesino/Luchador, AD" },
    { name: "Riven", role: "Luchadora, AD" },
    { name: "Rumble", role: "Luchador/Mago, AP" },
    { name: "Ryze", role: "Mago, AP" },
    { name: "Samira", role: "Tiradora, AD" },
    { name: "Sejuani", role: "Tanque/Luchadora, AP" },
    { name: "Senna", role: "Tiradora/Soporte, AD" },
    { name: "Seraphine", role: "Maga/Soporte, AP" },
    { name: "Sett", role: "Luchador/Tanque, AD" },
    { name: "Shaco", role: "Asesino, AD/AP" },
    { name: "Shen", role: "Tanque/Luchador, AD" },
    { name: "Shyvana", role: "Luchadora/Tanque, AP/AD" },
    { name: "Singed", role: "Tanque/Mago, AP" },
    { name: "Sion", role: "Tanque, AD" },
    { name: "Sivir", role: "Tiradora, AD" },
    { name: "Skarner", role: "Luchador/Tanque, AD" },
    { name: "Sona", role: "Soporte, AP" },
    { name: "Soraka", role: "Soporte, AP" },
    { name: "Swain", role: "Mago, AP" },
    { name: "Sylas", role: "Mago/Luchador, AP" },
    { name: "Syndra", role: "Maga, AP" },
    { name: "Tahm Kench", role: "Soporte/Tanque, AP" },
    { name: "Taliyah", role: "Maga, AP" },
    { name: "Talon", role: "Asesino, AD" },
    { name: "Taric", role: "Soporte/Tanque, AP" },
    { name: "Teemo", role: "Mago/Tirador, AP" },
    { name: "Thresh", role: "Soporte/Tanque, AP" },
    { name: "Tristana", role: "Tiradora, AD" },
    { name: "Trundle", role: "Luchador/Tanque, AD" },
    { name: "Tryndamere", role: "Luchador/Asesino, AD" },
    { name: "Twisted Fate", role: "Mago, AP" },
    { name: "Twitch", role: "Tirador, AD/AP" },
    { name: "Udyr", role: "Luchador/Tanque, AD" },
    { name: "Urgot", role: "Luchador/Tirador, AD" },
    { name: "Varus", role: "Tirador, AD/AP" },
    { name: "Vayne", role: "Tiradora, AD" },
    { name: "Veigar", role: "Mago, AP" },
    { name: "Vel'Koz", role: "Mago, AP" },
    { name: "Vex", role: "Maga, AP" },
    { name: "Vi", role: "Luchadora, AD" },
    { name: "Viego", role: "Asesino/Luchador, AD" },
    { name: "Viktor", role: "Mago, AP" },
    { name: "Vladimir", role: "Mago, AP" },
    { name: "Volibear", role: "Luchador/Tanque, AD" },
    { name: "Warwick", role: "Luchador/Tanque, AD" },
    { name: "Wukong", role: "Luchador/Tanque, AD" },
    { name: "Xayah", role: "Tiradora, AD" },
    { name: "Xerath", role: "Mago, AP" },
    { name: "Xin Zhao", role: "Luchador, AD" },
    { name: "Yasuo", role: "Luchador/Asesino, AD" },
    { name: "Yone", role: "Luchador/Asesino, AD" },
    { name: "Yorick", role: "Luchador, AD" },
    { name: "Yuumi", role: "Soporte, AP" },
    { name: "Zac", role: "Tanque, AP" },
    { name: "Zed", role: "Asesino, AD" },
    { name: "Zeri", role: "Tiradora, AD" },
    { name: "Ziggs", role: "Mago, AP" },
    { name: "Zilean", role: "Soporte/Mago, AP" },
    { name: "Zoe", role: "Maga, AP" },
    { name: "Zyra", role: "Maga/Soporte, AP" }
];

function sanitizarNombre(nombre) {
    return nombre.toLowerCase().replace(/['\s]/g, '');
}

const tablero = document.getElementById('tablero-juego');
const retroalimentacion = document.getElementById('retroalimentacion');
let filaActual = 0;
let casillaActual = 0;
const maxIntentos = 6;
let campeonElegidoObj;
let campeonElegido;
let longitudCampeon;

function elegirCampeon() {
    campeonElegidoObj = campeones[Math.floor(Math.random() * campeones.length)];
    campeonElegido = sanitizarNombre(campeonElegidoObj.name);
    longitudCampeon = campeonElegido.length;
    console.log("Campeón elegido:", campeonElegido);
}

function inicializarJuego() {
    elegirCampeon();
    inicializarTablero();
}

function inicializarTablero() {
    tablero.innerHTML = '';
    for (let i = 0; i < maxIntentos; i++) {
        const fila = document.createElement('div');
        fila.classList.add('fila');
        fila.style.gridTemplateColumns = `repeat(${longitudCampeon}, 1fr)`;
        for (let j = 0; j < longitudCampeon; j++) {
            const casilla = document.createElement('div');
            casilla.classList.add('casilla');
            fila.appendChild(casilla);
        }
        tablero.appendChild(fila);
    }
}

function mostrarImagenCampeon() {
    const imagenCampeon = document.getElementById('imagen-campeon');
    const nombreImagen = capitalizar(campeonElegidoObj.name);
    imagenCampeon.src = `img/${nombreImagen}.png`;
    imagenCampeon.style.display = "block";
    imagenCampeon.style.margin = "0 auto";
}

// Función para capitalizar el nombre correctamente (manteniendo el formato original)
function capitalizar(nombre) {
    return nombre.split(' ').map(palabra => 
        palabra.charAt(0).toUpperCase() + palabra.slice(1)
    ).join(' ');
}

// Actualizar el teclado virtual
const teclas = document.querySelectorAll('.tecla');
teclas.forEach(tecla => {
    tecla.addEventListener('click', () => {
        const valorTecla = tecla.textContent.toLowerCase();
        if (valorTecla === 'enter') {
            manejarIntento();
        } else if (valorTecla === '⌫' || valorTecla === 'backspace') { 
            eliminarLetra();
        } else {
            agregarLetra(valorTecla);
        }
    });
});

document.addEventListener('keydown', manejarTeclas);
function manejarTeclas(e) {
    const tecla = e.key.toLowerCase();

    if (tecla === 'enter') {
        manejarIntento();
        return;
    }

    if (tecla === 'backspace') {
        eliminarLetra();
        return;
    }

    if (/^[a-z]$/.test(tecla)) {
        agregarLetra(tecla);
    }
}

function agregarLetra(letra) {
    if (casillaActual < longitudCampeon) {
        const filaActualElemento = tablero.children[filaActual];
        const casilla = filaActualElemento.children[casillaActual];
        casilla.textContent = letra.toUpperCase();
        casilla.dataset.letra = letra;
        casillaActual++;
    }
}

function eliminarLetra() {
    if (casillaActual > 0) {
        casillaActual--;
        const filaActualElemento = tablero.children[filaActual];
        const casilla = filaActualElemento.children[casillaActual];
        casilla.textContent = '';
        delete casilla.dataset.letra;
    }
}

function manejarIntento() {
    const filaActualElemento = tablero.children[filaActual];
    const intento = Array.from(filaActualElemento.children)
        .map(casilla => casilla.dataset.letra)
        .join('');

    if (intento.length !== longitudCampeon) {
        retroalimentacion.textContent = "Debes completar la fila antes de verificar.";
        return;
    }

    const campeonValido = campeones.some(campeon => sanitizarNombre(campeon.name) === intento);
    if (!campeonValido) {
        retroalimentacion.textContent = "¡Campeón no válido!";
        return;
    }

    for (let i = 0; i < longitudCampeon; i++) {
        const casilla = filaActualElemento.children[i];
        const letra = casilla.dataset.letra.toLowerCase();

        if (letra === campeonElegido[i]) {
            casilla.classList.add('correcto');
            actualizarTecla(letra, 'correcto');
        } else if (campeonElegido.includes(letra)) {
            casilla.classList.add('presente');
            actualizarTecla(letra, 'presente');
        } else {
            casilla.classList.add('incorrecto');
            actualizarTecla(letra, 'incorrecto');
        }
    }

    if (intento === campeonElegido) {
        retroalimentacion.textContent = "¡Has adivinado el campeón!";
        mostrarImagenCampeon();
        deshabilitarEntrada();
    } else if (filaActual >= maxIntentos - 1) {
        retroalimentacion.textContent = `¡Juego terminado! El campeón era ${capitalizar(campeonElegidoObj.name)}.`;
        mostrarImagenCampeon();
        deshabilitarEntrada();
    } else {
        filaActual++;
        casillaActual = 0;
        retroalimentacion.textContent = "";
    }
}

// Actualizar el teclado virtual
function actualizarTecla(letra, clase) {
    teclas.forEach(tecla => {
        if (tecla.textContent.toLowerCase() === letra.toLowerCase()) {
            tecla.classList.remove('correcto', 'presente', 'incorrecto');
            tecla.classList.add(clase);
        }
    });
}

// Función para reiniciar la partida
function iniciarNuevaPartida() {
    // Reiniciar el tablero
    tablero.innerHTML = '';
    filaActual = 0;
    casillaActual = 0;
    elegirCampeon();
    inicializarTablero();
    retroalimentacion.textContent = '';
    teclas.forEach(tecla => {
        tecla.classList.remove('correcto', 'presente', 'incorrecto');
    });
    const imagenCampeon = document.getElementById('imagen-campeon');
    imagenCampeon.style.display = "none";
    habilitarEntrada();
}

const botonNuevaPartida = document.getElementById('nueva-partida');
botonNuevaPartida.addEventListener('click', iniciarNuevaPartida);
const botonObtenerPista = document.getElementById('obtener-pista');
botonObtenerPista.addEventListener('click', mostrarImagenCampeon);

// Deshabilitar la entrada de teclado después de terminar el juego
function deshabilitarEntrada() {
    document.removeEventListener('keydown', manejarTeclas);
    teclas.forEach(tecla => {
        tecla.disabled = true;
    });
}

// Habilitar la entrada de teclado al iniciar una nueva partida
function habilitarEntrada() {
    document.addEventListener('keydown', manejarTeclas);
    teclas.forEach(tecla => {
        tecla.disabled = false;
    });
}

// Añadir el event listener para el botón "Cambiar a Modo Oscuro"
const botonCambiarModo = document.getElementById('cambiar-modo');
botonCambiarModo.addEventListener('click', () => {
    document.body.classList.toggle('modo-oscuro');
    // Cambiar el texto del botón según el modo actual
    if (document.body.classList.contains('modo-oscuro')) {
        botonCambiarModo.textContent = "Cambiar a Modo Claro";
    } else {
        botonCambiarModo.textContent = "Cambiar a Modo Oscuro";
    }
});

inicializarJuego();

document.addEventListener('DOMContentLoaded', () => {
    // Llenar la lista de campeones
    const campeonesList = document.getElementById('campeones-list');
    campeones.forEach(campeon => {
        const listItem = document.createElement('li');
        listItem.textContent = campeon.name;
        campeonesList.appendChild(listItem);
    });

    const botonMostrarLista = document.getElementById('mostrar-lista');
    const listaCampeones = document.getElementById('lista-campeones');

    botonMostrarLista.addEventListener('click', () => {
        listaCampeones.classList.toggle('oculto');
    });
});
