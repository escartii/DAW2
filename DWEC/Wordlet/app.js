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
const chosenChampion = champions[Math.floor(Math.random() * champions.length)].name.toLowerCase();

const board = document.getElementById('game-board');
const input = document.getElementById('user-input');
const submitBtn = document.getElementById('submit-btn');
const feedback = document.getElementById('feedback');

let attempt = 0;
const maxAttempts = 6;
let currentRow = 0;

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

submitBtn.addEventListener('click', handleGuess);

function handleGuess() {
    const guess = input.value.toLowerCase();
    if (guess.length !== 5) {
        feedback.textContent = "¡Los nombres de los campeones deben tener 5 letras!";
        return;
    }

    const validChampion = champions.some(champion => champion.name.toLowerCase() === guess);
    if (!validChampion) {
        feedback.textContent = "¡Campeón no válido!";
        return;
    }

    const currentRowElement = board.children[currentRow];
    for (let i = 0; i < 5; i++) {
        const tile = currentRowElement.children[i];
        tile.textContent = guess[i].toUpperCase();
        if (guess[i] === chosenChampion[i]) {
            tile.classList.add('correct');
        } else if (chosenChampion.includes(guess[i])) {
            tile.classList.add('present');
        } else {
            tile.classList.add('wrong');
        }
    }

    if (guess === chosenChampion) {
        feedback.textContent = "¡Has adivinado el campeón!";
        submitBtn.disabled = true;
    } else if (currentRow >= maxAttempts - 1) {
        feedback.textContent = `¡Juego terminado! El campeón era ${capitalize(chosenChampion)}.`;
        submitBtn.disabled = true;
    } else {
        feedback.textContent = "";
        currentRow++;
    }
    input.value = '';
    attempt++;
}

function capitalize(word) {
    return word.charAt(0).toUpperCase() + word.slice(1);
}
