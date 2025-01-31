function abrirModal() {
    document.getElementById("fondo").classList.remove("oculto");
    document.getElementById("modal").classList.remove("oculto");
    
    const cerrarModalBtn = document.getElementById("salir");
    cerrarModalBtn.addEventListener("click", chaparModal);
    document.addEventListener("keydown", handleKeyDown);
}

function chaparModal() {
    document.getElementById("fondo").classList.add("oculto");
    document.getElementById("modal").classList.add("oculto");
    document.removeEventListener("keydown", handleKeyDown);
    
    const cerrarModalBtn = document.getElementById("salir");
    cerrarModalBtn.removeEventListener("click", chaparModal);
}

function handleKeyDown(event) {
    if (event.key === "Escape") {
        chaparModal();
    }
}

function crearTabla(data, estado) {
    const titulo = document.getElementById('titulo');
    titulo.textContent = `Clima en ${estado}`;

    const tbody = document.getElementById('tbody');
    tbody.innerHTML = '';
    data.forEach((hora) => {
        const fila = document.createElement('tr');
        
        // Hora
        const tdHora = document.createElement('td');
        const iconoHora = document.createElement('i');
        iconoHora.classList.add('fa-regular', 'fa-clock', 'me-2');
        tdHora.appendChild(iconoHora);
        
        const fechaHora = new Date(hora.validt * 1000).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const textoHora = document.createTextNode(fechaHora);
        tdHora.appendChild(textoHora);
        fila.appendChild(tdHora);
        
        const tdTemp = document.createElement('td');
        const iconoTemp = document.createElement('i');
        iconoTemp.classList.add('fa-solid', 'fa-temperature-high', 'me-2');
        tdTemp.appendChild(iconoTemp);
        
        const tempCelsius = Math.round((hora.temp - 32) * 5 / 9);
        tdTemp.appendChild(document.createTextNode(`${tempCelsius} °C`));
        fila.appendChild(tdTemp);
        
        const tdViento = document.createElement('td');
        const iconoViento = document.createElement('i');
        iconoViento.classList.add('fa-solid', 'fa-wind', 'me-2');
        tdViento.appendChild(iconoViento);
        tdViento.appendChild(document.createTextNode(`${hora.wspd} mph`));
        fila.appendChild(tdViento);
        
        const tdDir = document.createElement('td');
        const iconoDir = document.createElement('i');
        iconoDir.classList.add('fa-solid', 'fa-compass', 'me-2', 'rotar-icono');
        iconoDir.style.transform = `rotate(${hora.wdir}deg)`;
        tdDir.appendChild(iconoDir);
        tdDir.appendChild(document.createTextNode(hora.wdir_compass));
        fila.appendChild(tdDir);
        
        tbody.appendChild(fila);
    });
}



const estados = {
    Alabama: { latitude: 32.806671, longitude: -86.79113 },
    Alaska: { latitude: 61.370716, longitude: -152.404419 },
    Arizona: { latitude: 33.729759, longitude: -111.431221 },
    Arkansas: { latitude: 34.969704, longitude: -92.373123 },
    California: { latitude: 36.116203, longitude: -119.681564 },
    Colorado: { latitude: 39.550051, longitude: -105.782067 },
    Connecticut: { latitude: 41.603221, longitude: -73.087749 },
    Delaware: { latitude: 38.910832, longitude: -75.52767 },
    Florida: { latitude: 27.766279, longitude: -81.686783 },
    Georgia: { latitude: 33.040619, longitude: -83.643074 },
    Hawái: { latitude: 21.094318, longitude: -157.498337 },
    Idaho: { latitude: 44.299782, longitude: -114.513285 },
    Illinois: { latitude: 40.673358, longitude: -89.398528 },
    Indiana: { latitude: 39.838434, longitude: -86.158043 },
    Iowa: { latitude: 42.011539, longitude: -93.210526 },
    Kansas: { latitude: 38.5266, longitude: -96.726486 },
    Kentucky: { latitude: 37.66814, longitude: -84.670067 },
    Luisiana: { latitude: 31.169546, longitude: -91.867805 },
    Maine: { latitude: 44.693947, longitude: -69.381927 },
    Maryland: { latitude: 39.063946, longitude: -76.802101 },
    Massachusetts: { latitude: 42.230171, longitude: -71.530106 },
    Míchigan: { latitude: 42.326515, longitude: -83.636719 },
    Minnesota: { latitude: 46.729553, longitude: -94.685899 },
    Misisipi: { latitude: 32.741646, longitude: -89.678696 },
    Misuri: { latitude: 36.5361, longitude: -89.831234 },
    Montana: { latitude: 46.921925, longitude: -110.454353 },
    Nebraska: { latitude: 41.12537, longitude: -98.268082 },
    Nevada: { latitude: 38.313515, longitude: -117.055374 },
    "Nuevo Hampshire": { latitude: 43.452492, longitude: -71.563896 },
    "Nueva Jersey": { latitude: 40.298904, longitude: -74.521011 },
    "Nuevo México": { latitude: 34.840515, longitude: -106.248482 },
    "Nueva York": { latitude: 40.712776, longitude: -74.005974 },
    "Carolina del Norte": { latitude: 35.630066, longitude: -79.806419 },
    "Dakota del Norte": { latitude: 47.528912, longitude: -99.784012 },
    Ohio: { latitude: 40.388783, longitude: -82.764915 },
    Oklahoma: { latitude: 35.565342, longitude: -96.928917 },
    Oregón: { latitude: 43.930092, longitude: -119.695846 },
    Pensilvania: { latitude: 40.590752, longitude: -77.209755 },
    "Rhode Island": { latitude: 41.680894, longitude: -71.51178 },
    "Carolina del Sur": { latitude: 33.856892, longitude: -80.945007 },
    "Dakota del Sur": { latitude: 44.299782, longitude: -99.438828 },
    Tennessee: { latitude: 35.747845, longitude: -86.692345 },
    Texas: { latitude: 31.054487, longitude: -97.563461 },
    Utah: { latitude: 40.150032, longitude: -111.862434 },
    Vermont: { latitude: 44.045876, longitude: -72.710686 },
    Virginia: { latitude: 37.769337, longitude: -78.169968 },
    Washington: { latitude: 47.400902, longitude: -121.490495 },
    "Virginia Occidental": { latitude: 38.491226, longitude: -80.954522 },
    Wisconsin: { latitude: 43.78444, longitude: -88.787868 },
    Wyoming: { latitude: 42.755966, longitude: -107.30249 },
};


document.addEventListener("DOMContentLoaded", function () {
    let areas = document.querySelectorAll('area') 
    for (let i = 0; i < areas.length; i++) {
        areas[i].addEventListener('click', async function () {
            console.log(areas[i].title);
            abrirModal();
            let response = await fetch(`https://api.weatherusa.net/v1/forecast?q=${estados[areas[i].title].latitude},${estados[areas[i].title].longitude}&daily=0&units=e&maxtime=1d`);
            let data = await response.json();
            // console.log(data);
            crearTabla(data, areas[i].title);
            const responseIMG = await fetch(`https://api.weatherusa.net/v1/skycams?q=${estados[areas[i].title].latitude},${estados[areas[i].title].longitude}`);
            const dataIMG = await responseIMG.json();
            CrearImg(dataIMG, areas[i].title);
        });
    };
});

function CrearImg(data, title) {
    let div = document.getElementById("camara-web");

    let img = data[0];

    div.innerHTML = `<img src="${img.image}" alt="${title}" width="700" />`;

}