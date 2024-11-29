// Ejemplo de cómo agregar elementos a las listas dinámicamente
const videoList = document.getElementById('video-list');
const audioList = document.getElementById('audio-list');
const mainVideo = document.getElementById('main-video');
const muteBtn = document.getElementById('mute-btn');
const rewindBtn = document.getElementById('rewind-btn');
const playPauseBtn = document.getElementById('play-pause-btn');
const forwardBtn = document.getElementById('forward-btn');
const restartBtn = document.getElementById('restart-btn');
const volumeUpBtn = document.getElementById('volume-up-btn');
const volumeDownBtn = document.getElementById('volume-down-btn');

// Arreglos con los datos de los videos y la música
const videos = [
    { id: 1, title: 'Waterfall', url: 'waterfall.mp4' },
    { id: 2, title: 'Beach', url: 'beach.mp4' },
    { id: 3, title: 'Forest', url: 'forest.mp4' },
    { id: 4, title: 'Cafe', url: 'cafe.mp4' }
];

const audios = [
    { id: 1, title: 'Jazz', url: 'jazz.mp3' },
    { id: 2, title: 'Soul', url: 'soul.mp3' },
    { id: 3, title: 'Nature', url: 'nature.mp3' },
    { id: 4, title: 'Lofi', url: 'lofi.mp3' }
];

// Función para crear un elemento de lista
function createListItem(list, item) {
    const li = document.createElement('li');
    li.textContent = item.title;
    li.dataset.url = item.url;
    list.appendChild(li);
    li.addEventListener('click', () => {
        mainVideo.src = item.url;
        mainVideo.play();
    });
}

// Agregar los elementos a las listas
videos.forEach(video => createListItem(videoList, video));
audios.forEach(audio => createListItem(audioList, audio));

// Agregar event listeners a los controles de video
let isMuted = false;
muteBtn.addEventListener('click', () => {
    if (isMuted) {
        mainVideo.muted = false;
        muteBtn.textContent = '🔇';
    } else {
        mainVideo.muted = true;
        muteBtn.textContent = '🔊';
    }
    isMuted = !isMuted;
});

rewindBtn.addEventListener('click', () => {
    mainVideo.currentTime -= 10;
});

playPauseBtn.addEventListener('click', () => {
    if (mainVideo.paused) {
        mainVideo.play();
        playPauseBtn.textContent = '⏸';
    } else {
        mainVideo.pause();
        playPauseBtn.textContent = '▶️';
    }
});

forwardBtn.addEventListener('click', () => {
    mainVideo.currentTime += 10;
});

restartBtn.addEventListener('click', () => {
    mainVideo.currentTime = 0;
    mainVideo.play();
});

volumeUpBtn.addEventListener('click', () => {
    mainVideo.volume = Math.min(mainVideo.volume + 0.1, 1);
});

volumeDownBtn.addEventListener('click', () => {
    mainVideo.volume = Math.max(mainVideo.volume - 0.1, 0);
});