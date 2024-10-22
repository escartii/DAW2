// Lista de campeones de League of Legends con exactamente 5 caracteres y sus roles
const champions = [
    { name: "Akali", role: "Asesina, AP" },
    { name: "Annie", role: "Maga, AP" },
    { name: "Bardo", role: "Soporte, AP" },
    { name: "Brand", role: "Mago, AP" },
    { name: "Braum", role: "Soporte/Tanque, AD" },
    { name: "Corki", role: "Tirador, AD/AP" },
    { name: "Diana", role: "Asesina/Maga, AP" },
    { name: "Elise", role: "Maga/Luchadora, AP" },
    { name: "Fiora", role: "Luchadora, AD" },
    { name: "Galio", role: "Tanque/Mago, AP" },
    { name: "Garen", role: "Tanque/Luchador, AD" },
    { name: "Ivern", role: "Soporte/Mago, AP" },
    { name: "Janna", role: "Soporte, AP" },
    { name: "Jayce", role: "Luchador/Tirador, AD" },
    { name: "Karma", role: "Maga/Soporte, AP" },
    { name: "Kayle", role: "Luchadora/Maga, AP/AD" },
    { name: "Leona", role: "Soporte/Tanque, AD" },
    { name: "Nasus", role: "Luchador/Tanque, AD" },
    { name: "Neeko", role: "Maga, AP" },
    { name: "Poppy", role: "Tanque/Luchadora, AD" },
    { name: "Quinn", role: "Tiradora, AD" },
    { name: "Rakan", role: "Soporte, AP" },
    { name: "Riven", role: "Luchadora, AD" },
    { name: "Senna", role: "Tiradora/Soporte, AD" },
    { name: "Shaco", role: "Asesino, AD/AP" },
    { name: "Sivir", role: "Tiradora, AD" },
    { name: "Swain", role: "Mago, AP" },
    { name: "Sylas", role: "Mago/Luchador, AP" },
    { name: "Talon", role: "Asesino, AD" },
    { name: "Taric", role: "Soporte/Tanque, AP" },
    { name: "Teemo", role: "Mago/Tirador, AP" },
    { name: "Urgot", role: "Luchador/Tirador, AD" },
    { name: "Varus", role: "Tirador, AD/AP" },
    { name: "Vayne", role: "Tiradora, AD" },
    { name: "Viego", role: "Asesino/Luchador, AD" },
    { name: "Xayah", role: "Tiradora, AD" },
    { name: "Yasuo", role: "Luchador/Asesino, AD" },
    { name: "Yuumi", role: "Soporte, AP" },
    { name: "Ziggs", role: "Mago, AP" },
];

// Elegir un campeón aleatoriamente
const chosenChampionObj = champions[Math.floor(Math.random() * champions.length)];
const chosenChampion = chosenChampionObj.name.toLowerCase();
console.log(chosenChampion);

const board = document.getElementById('game-board');
const feedback = document.getElementById('feedback');
let currentRow = 0;
let currentTile = 0;
const maxAttempts = 6;

// Inicializar el tablero
function initBoard() {
    for (let i = 0; i < maxAttempts; i++) {
        const row = document.createElement('div');
        row.classList.add('row');
        for (let j = 0; j < 5; j++) {
            const tile = document.createElement('div');
            tile.classList.add('tile');
            row.appendChild(tile);
        }
        board.appendChild(row);
    }
}

initBoard();

// Mostrar la imagen del campeón
function showChampionImage() {
    const championImage = document.getElementById('champion-image');
    championImage.src = `./img/${chosenChampion}.png`; // Asumiendo que las imágenes tienen el nombre del campeón
    championImage.style.display = "block"; // Mostrar la imagen
    championImage.style.margin = "0 auto"; // Centrar la imagen horizontalmente
}

// Agregar el event listener para el botón de "Obtener Pista"
const pistaButton = document.getElementById('obtener-pista');
pistaButton.addEventListener('click', showChampionImage);

// Manejar las teclas virtuales
const keys = document.querySelectorAll('.key');
keys.forEach(key => {
    key.addEventListener('click', () => {
        const keyValue = key.textContent.toLowerCase();
        if (keyValue === 'enter') {
            handleGuess();
        } else if (keyValue === '⌫') {
            deleteLetter();
        } else {
            addLetter(keyValue);
        }
    });
});

// Detectar teclas físicas
document.addEventListener('keydown', (e) => {
    const key = e.key.toLowerCase();

    if (key === 'enter') {
        handleGuess();
        return;
    }

    if (key === 'backspace') {
        deleteLetter();
        return;
    }

    if (/^[a-z]$/.test(key)) {
        addLetter(key);
    }
});

// Agregar letras a las casillas
function addLetter(letter) {
    if (currentTile < 5) {
        const currentRowElement = board.children[currentRow];
        const tile = currentRowElement.children[currentTile];
        tile.textContent = letter.toUpperCase();
        tile.dataset.letter = letter;
        currentTile++;
    }
}

// Eliminar la última letra
function deleteLetter() {
    if (currentTile > 0) {
        currentTile--;
        const currentRowElement = board.children[currentRow];
        const tile = currentRowElement.children[currentTile];
        tile.textContent = '';
        delete tile.dataset.letter;
    }
}

// Mostrar/ocultar alertas
function showAlert(type) {
    const successAlert = document.getElementById('alert-success');
    const dangerAlert = document.getElementById('alert-danger');
    const correctChampionEl = document.getElementById('correct-champion');
    
    // Ocultar ambas alertas antes de mostrar la correcta
    successAlert.classList.add('hidden');
    dangerAlert.classList.add('hidden');

    if (type === 'success') {
        successAlert.classList.remove('hidden');
    } else if (type === 'danger') {
        dangerAlert.classList.remove('hidden');
        correctChampionEl.textContent = capitalize(chosenChampion); // Mostrar el campeón correcto
    }
}

// Manejar el intento
function handleGuess() {
    const currentRowElement = board.children[currentRow];
    const guess = Array.from(currentRowElement.children)
        .map(tile => tile.dataset.letter)
        .join('');

    if (guess.length !== 5) {
        feedback.textContent = "Debes completar la fila antes de verificar.";
        return;
    }

    const validChampion = champions.some(champion => champion.name.toLowerCase() === guess);
    if (!validChampion) {
        feedback.textContent = "¡Campeón no válido!";
        return;
    }

    // Pintar las letras según la coincidencia
    for (let i = 0; i < 5; i++) {
        const tile = currentRowElement.children[i];
        const letter = tile.dataset.letter;

        if (letter === chosenChampion[i]) {
            tile.classList.add('correct');
            updateKey(letter, 'correct');
        } else if (chosenChampion.includes(letter)) {
            tile.classList.add('present');
            updateKey(letter, 'present');
        } else {
            tile.classList.add('wrong');
            updateKey(letter, 'wrong');
        }
    }

    // Verificar si el jugador ha ganado o si ha terminado el juego
    if (guess === chosenChampion) {
        feedback.textContent = "¡Has adivinado el campeón!";
        showAlert('success'); // Mostrar alerta verde
        showChampionImage(); // Mostrar la imagen del campeón
        document.removeEventListener('keydown', handleGuess);
    } else if (currentRow >= maxAttempts - 1) {
        feedback.textContent = `¡Juego terminado! El campeón era ${capitalize(chosenChampion)}.`;
        showAlert('danger'); // Mostrar alerta roja
        showChampionImage(); // Mostrar la imagen del campeón
        document.removeEventListener('keydown', handleGuess);
    } else {
        currentRow++;
        currentTile = 0;
        feedback.textContent = "";
    }
}

// Actualizar el teclado
function updateKey(letter, className) {
    keys.forEach(key => {
        if (key.textContent.toLowerCase() === letter.toLowerCase()) {
            key.classList.add(className);
        }
    });
}

// Capitalizar la primera letra
function capitalize(word) {
    return word.charAt(0).toUpperCase() + word.slice(1);
}

const toggleButton = document.getElementById('toggle-mode');
const body = document.body;

// Comprobar el modo almacenado
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    toggleButton.textContent = "Cambiar a Modo Claro";
}

toggleButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');

    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        toggleButton.textContent = "Cambiar a Modo Claro";
    } else {
        localStorage.setItem('theme', 'light');
        toggleButton.textContent = "Cambiar a Modo Oscuro";
    }
});
