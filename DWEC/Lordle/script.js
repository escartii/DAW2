let champions = {}; // Aquí se cargará el JSON de campeones.
let selectedChampion = null;
let maxAttempts = 6;
let attempts = 0;

// Cargar el archivo JSON y esperar a que esté completamente cargado antes de usar los datos.
async function loadChampions() {
    try {
        const response = await fetch('champions.json');
        if (!response.ok) {
            throw new Error("Error al cargar el JSON");
        }
        const data = await response.json();
        champions = data.data; // Acceder al contenedor "data" donde están los campeones
        chooseRandomChampion();
    } catch (error) {
        console.error("Error cargando campeones:", error);
    }
}

// Elegir un campeón al azar
function chooseRandomChampion() {
    const keys = Object.keys(champions);
    const randomIndex = Math.floor(Math.random() * keys.length);
    selectedChampion = champions[keys[randomIndex]];
    console.log(`Campeón seleccionado: ${selectedChampion.name}`);
}

// Función para comparar tags y partype y mostrar el resultado
function compareChampion(guessedChampion) {
    const feedbackElement = document.getElementById('feedback');
    feedbackElement.innerHTML = '';  // Limpiar feedback anterior

    // Comparar los tags (roles) y el partype (recurso) del campeón adivinado y seleccionado
    const championProperties = [
        { label: 'Tags', userValue: guessedChampion.tags.join(', '), correctValue: selectedChampion.tags.join(', ') },
        { label: 'Partype', userValue: guessedChampion.partype, correctValue: selectedChampion.partype }
    ];

    // Generar HTML para las comparaciones
    championProperties.forEach(prop => {
        const isCorrect = prop.userValue === prop.correctValue;
        const color = isCorrect ? 'green' : 'red';
        const propElement = document.createElement('div');
        propElement.innerHTML = `<span style="color: ${color}">${prop.label}: ${prop.userValue}</span>`;
        propElement.classList.add(isCorrect ? 'green' : 'red');
        feedbackElement.appendChild(propElement);
    });
}

// Comprobar adivinanza
document.getElementById('submitGuess').addEventListener('click', function() {
    const guess = document.getElementById('guessInput').value.trim();
    if (guess === "") return;

    attempts++;
    
    if (attempts > maxAttempts) {
        document.getElementById('feedback').innerText = "¡Se han acabado los intentos!";
        return;
    }

    // Buscar el campeón en el JSON
    const guessedChampion = Object.values(champions).find(champion => champion.name.toLowerCase() === guess.toLowerCase());

    if (guessedChampion) {
        compareChampion(guessedChampion);
        if (guessedChampion.name.toLowerCase() === selectedChampion.name.toLowerCase()) {
            document.getElementById('feedback').innerText = `¡Correcto! El campeón es ${selectedChampion.name}.`;
            attempts = 0;
        } else {
            document.getElementById('feedback').innerText = `Intento incorrecto, sigue intentando. Intentos restantes: ${maxAttempts - attempts}`;
        }
    } else {
        document.getElementById('feedback').innerText = "El campeón no fue encontrado. Inténtalo nuevamente.";
    }

    document.getElementById('attempts').innerText = `Intentos: ${attempts}`;
});

// Cargar los campeones al inicio
loadChampions();
                              