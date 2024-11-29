// Función para actualizar la hora
function actualizarHora() {
    let horaActual = new Date();
    let horas = String(horaActual.getHours()).padStart(2, '0');
    let minutos = String(horaActual.getMinutes()).padStart(2, '0');
    let segundos = String(horaActual.getSeconds()).padStart(2, '0');
    let tiempoParseado = `${horas}:${minutos}:${segundos}`;

    document.getElementById('hora').textContent = tiempoParseado;
}

setInterval(actualizarHora, 1000);
actualizarHora();

// Simulación de los archivos en la carpeta (en un entorno real, usa un backend para obtener esta lista)
const videos = ['video1.mp4', 'video2.mp4', 'video3.mp4', 'video4.mp4'];
const audios = ['audio1.mp3', 'audio2.mp3', 'audio3.mp3', 'audio4.mp3'];

// Función para mostrar la ventana de directorios
function mostrarVentana(tipo) {
    // Crear la ventana emergente
    const ventana = document.createElement('div');
    ventana.classList.add('ventana');

    // Crear el contenido
    const contenido = document.createElement('div');
    contenido.classList.add('contenido');

    const titulo = document.createElement('h2');
    titulo.textContent = tipo === 'videos' ? 'Vídeos' : 'Audios';

    // Añadir los elementos (imágenes con nombres)
    const elementos = document.createElement('div');
    elementos.classList.add('elementos');

    let archivos = "";
    if (tipo === 'videos') {
        archivos = videos;
    } else {
        archivos = audios;
    }

    archivos.forEach(archivo => {
        const contenedor = document.createElement('div');
        contenedor.classList.add('item');

        const imagen = document.createElement('img');
        imagen.src = tipo === 'videos' ? './img/videos.png' : './img/audios.png'; // Imagen de representación
        imagen.alt = archivo;
        imagen.style.cursor = 'pointer';

        // Evento al hacer clic en la imagen
        imagen.addEventListener('click', () => {
            cargarArchivo(archivo, tipo);
        });

        const nombre = document.createElement('p');
        nombre.textContent = archivo; // Mostrar el nombre del archivo

        contenedor.appendChild(imagen);
        contenedor.appendChild(nombre);
        elementos.appendChild(contenedor);
    });

    // Botón para cerrar la ventana
    const cerrar = document.createElement('button');
    cerrar.textContent = 'Cerrar';
    cerrar.classList.add('cerrar');
    cerrar.addEventListener('click', () => {
        ventana.remove();
    });

    // Añadir los elementos al contenido
    contenido.appendChild(titulo);
    contenido.appendChild(elementos);
    contenido.appendChild(cerrar);

    // Añadir contenido a la ventana
    ventana.appendChild(contenido);

    // Añadir la ventana al cuerpo
    document.body.appendChild(ventana);
}

// Función para cargar el archivo seleccionado
function cargarArchivo(archivo, tipo) {
    const contenido = document.querySelector('.contenido');
    contenido.innerHTML = ''; // Limpiar el contenido

    const titulo = document.createElement('h2');
    titulo.textContent = `Reproduciendo ${archivo}`;
    contenido.appendChild(titulo);

    let videoElement;

    if (tipo === 'videos') {
        videoElement = document.createElement('video');
        videoElement.src = `./videos/${archivo}`;
        videoElement.controls = true;
        videoElement.style.width = '100%';
        videoElement.autoplay = false; // No iniciar automáticamente
        videoElement.load(); // Cargar el video pero mantenerlo pausado
        contenido.appendChild(videoElement);

        const mensaje = document.createElement('p');
        mensaje.textContent = 'Selecciona un audio para comenzar la reproducción.';
        mensaje.style.color = 'red';
        contenido.appendChild(mensaje);

        // Botón para elegir un audio adicional
        const botonAudio = document.createElement('button');
        botonAudio.textContent = 'Elegir audio';
        botonAudio.classList.add('boton-audio');
        contenido.appendChild(botonAudio);

        botonAudio.addEventListener('click', () => {
            mostrarAudios(videoElement); // Mostrar audios y gestionar sincronización
        });
    }

    // Botón para cerrar la ventana
    const cerrar = document.createElement('button');
    cerrar.textContent = 'Cerrar';
    cerrar.classList.add('cerrar');
    cerrar.addEventListener('click', () => {
        document.querySelector('.ventana').remove(); // Eliminar la ventana completa
    });

    contenido.appendChild(cerrar);
}

// Función para mostrar los audios disponibles
function mostrarAudios(videoElement) {
    const contenido = document.querySelector('.contenido');
    contenido.innerHTML = ''; // Limpiar el contenido actual

    const titulo = document.createElement('h2');
    titulo.textContent = 'Selecciona un audio para sincronizar';
    contenido.appendChild(titulo);

    const elementos = document.createElement('div');
    elementos.classList.add('elementos');

    audios.forEach(audio => {
        const contenedor = document.createElement('div');
        contenedor.classList.add('item');

        const imagen = document.createElement('img');
        imagen.src = './img/audios.png'; // Imagen representativa para los audios
        imagen.alt = audio;
        imagen.style.cursor = 'pointer';

        const nombre = document.createElement('p');
        nombre.textContent = audio;

        // Al seleccionar un audio, se reproduce junto al video
        imagen.addEventListener('click', () => {
            sincronizarAudio(videoElement, `./audios/${audio}`);
        });

        contenedor.appendChild(imagen);
        contenedor.appendChild(nombre);
        elementos.appendChild(contenedor);
    });

    contenido.appendChild(elementos);

    // Botón para volver al video
    const volver = document.createElement('button');
    volver.textContent = 'Volver al video';
    volver.classList.add('cerrar');
    volver.addEventListener('click', () => {
        cargarArchivo(videoElement.src.split('/').pop(), 'videos');
    });

    contenido.appendChild(volver);
}

// Función para sincronizar el audio con el video
function sincronizarAudio(videoElement, audioSrc) {
    const contenido = document.querySelector('.contenido');
    contenido.innerHTML = ''; // Limpiar el contenido actual

    const titulo = document.createElement('h2');
    titulo.textContent = 'Reproduciendo video y audio sincronizados';
    contenido.appendChild(titulo);

    const video = videoElement.cloneNode(true);
    video.controls = true;
    contenido.appendChild(video);

    const audio = document.createElement('audio');
    audio.src = audioSrc;
    audio.controls = true;
    contenido.appendChild(audio);

    // Sincronizar los tiempos de video y audio
    video.addEventListener('play', () => {
        audio.play();
    });

    video.addEventListener('pause', () => {
        audio.pause();
    });

    video.addEventListener('timeupdate', () => {
        if (Math.abs(video.currentTime - audio.currentTime) > 0.1) {
            audio.currentTime = video.currentTime;
        }
    });

    video.play();

    // Botón para cerrar la ventana
    const cerrar = document.createElement('button');
    cerrar.textContent = 'Cerrar';
    cerrar.classList.add('cerrar');
    cerrar.addEventListener('click', () => {
        document.querySelector('.ventana').remove(); // Eliminar la ventana completa
    });

    contenido.appendChild(cerrar);
}

// Event listeners para las imágenes y la Pantalla de Inicio
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('img[alt="directorios"]').addEventListener('dblclick', () => {
        mostrarVentana('videos');
    });

    document.getElementById('directorio2').addEventListener('dblclick', () => {
        mostrarVentana('audios');
    });

    /* Funcionalidad de la Pantalla de Inicio */
    const startButton = document.getElementById('startButton');
    const initialOverlay = document.getElementById('initialOverlay');
    const mainContent = document.getElementById('mainContent');

    startButton.addEventListener('click', () => {
        // Añadir animación de salida
        initialOverlay.classList.add('fadeOut');

        // Esperar a que termine la animación antes de ocultar el overlay
        initialOverlay.addEventListener('animationend', () => {
            initialOverlay.style.display = 'none';
            mainContent.style.display = 'block';
        }, { once: true }); // Eliminar el listener después de la primera ejecución
    });
});
