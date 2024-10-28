
        let intervalo;
        let tiempo = 0;
        let pelotasEliminadas = 0;
        let totalPelotasColor = 0;
        let errores = 0;

        document.getElementById('modo').addEventListener('change', function() {
            const colorSelect = document.getElementById('colorSelect');
            if (this.value === 'color') {
                colorSelect.style.display = 'block';
            } else {
                colorSelect.style.display = 'none';
            }
        });

        function generarColorAleatorio() {
            const letras = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letras[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function iniciarJuego() {
            // Reiniciar contadores y mensaje
            tiempo = 0;
            pelotasEliminadas = 0;
            totalPelotasColor = 0;
            errores = 0;
            document.getElementById('tiempo').textContent = tiempo;
            document.getElementById('eliminadas').textContent = pelotasEliminadas;
            document.getElementById('mensaje').textContent = '';
            clearInterval(intervalo);
            intervalo = setInterval(() => {
                tiempo++;
                document.getElementById('tiempo').textContent = tiempo;
            }, 1000);

            crearPelotas();
        }

        function crearPelotas() {
            const cantidad = parseInt(document.getElementById('cantidad').value);
            const modo = document.getElementById('modo').value;
            const colorSeleccionado = document.querySelector('input[name="color"]:checked');
            const divJuego = document.getElementById('juego');

            divJuego.innerHTML = ''; // Limpiar pelotas anteriores

            for (let i = 0; i < cantidad; i++) {
                const pelota = document.createElement('div');
                pelota.classList.add('pelota');
                const size = Math.floor(Math.random() * 50) + 20;
                pelota.style.width = `${size}px`;
                pelota.style.height = `${size}px`;
                pelota.style.left = `${Math.floor(Math.random() * (divJuego.clientWidth - size))}px`;
                pelota.style.top = `${Math.floor(Math.random() * (divJuego.clientHeight - size))}px`;

                if (modo === 'color' && colorSeleccionado) {
                    if (i < cantidad / 2) {
                        pelota.classList.add(colorSeleccionado.value);
                        totalPelotasColor++;
                    } else {
                        pelota.style.backgroundColor = generarColorAleatorio();
                    }
                } else {
                    pelota.style.backgroundColor = generarColorAleatorio();
                }

                pelota.addEventListener('click', () => {
                    if (modo === 'color' && colorSeleccionado && pelota.classList.contains(colorSeleccionado.value)) {
                        pelota.classList.add('ocultar');
                        pelotasEliminadas++;
                        totalPelotasColor--;
                        if (totalPelotasColor === 0) {
                            finDelJuego(true);
                        }
                    } else if (modo === 'todas' || !colorSeleccionado) {
                        pelota.classList.add('ocultar');
                        pelotasEliminadas++;
                        if (pelotasEliminadas === cantidad) {
                            finDelJuego(true);
                        }
                    } else {
                        errores++;
                        if (errores === 3) {
                            finDelJuego(false);
                        }
                    }
                    document.getElementById('eliminadas').textContent = pelotasEliminadas;
                });

                divJuego.appendChild(pelota);
            }
        }

        function finDelJuego(ganado) {
            clearInterval(intervalo);
            if (ganado) {
                document.getElementById('mensaje').textContent = `¡Fin del juego! Has tardado ${tiempo} segundos.`;
            } else {
                document.getElementById('mensaje').textContent = `¡Has perdido! Has seleccionado 3 pelotas incorrectas.`;
            }
        }