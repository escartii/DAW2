const app = Vue.createApp({
    data() {
      return {
        titulo: "Batalla Pokémon",
        todosLosPokemon: [], // Todos los Pokémon (1ª generación)
        pokemonsJugador1: Array.from({ length: 5 }, () => ({})), // 5 cartas para el jugador 1
        pokemonsJugador2: Array.from({ length: 5 }, () => ({})), // 5 cartas para el jugador 2
        modalAbierto: false,
        // Variables para la pelea 1
        activePokemonJugador1: null,
        activePokemonJugador2: null,
        battleModalAbierto: false,
        turno: 1,
        battleLog: [],
        batallaFinalizada: false,
        // Índices para llevar el orden de los Pokémon en cada equipo
        indexActivoJugador1: 0,
        indexActivoJugador2: 0
      };
    },
    computed: {
      // Número de Pokémon no derrotados por equipo
      remainingJugador1() {
        return this.pokemonsJugador1.filter(p => p.nombre && !p.derrota).length;
      },
      remainingJugador2() {
        return this.pokemonsJugador2.filter(p => p.nombre && !p.derrota).length;
      }
    },
    mounted() {
      this.obtenerPokemon();
    },
    methods: {
      // Obtiene los 151 primeros Pokémon de la API (incluyendo movimientos)
      async obtenerPokemon() {
        const primeraGeneracion = [];
        for (let i = 1; i <= 151; i++) {
          primeraGeneracion.push(
            fetch(`https://pokeapi.co/api/v2/pokemon/${i}`).then(res => res.json())
          );
        }
        const datosPokemon = await Promise.all(primeraGeneracion);
        this.todosLosPokemon = datosPokemon.map(pokemon => ({
          nombre: pokemon.name,
          sprites: pokemon.sprites,
          stats: pokemon.stats,
          movimientos: pokemon.moves, // Se guardan los movimientos
          derrota: false
        }));
      },

      // Selección manual desde el modal: se asigna el Pokémon al primer espacio vacío
      seleccionarPokemon(pokemon) {
        if (this.pokemonsJugador1.some(p => !p.nombre)) {
          const indice = this.pokemonsJugador1.findIndex(p => !p.nombre);
          this.pokemonsJugador1[indice] = Object.assign({}, pokemon);
        } else if (this.pokemonsJugador2.some(p => !p.nombre)) {
          const indice = this.pokemonsJugador2.findIndex(p => !p.nombre);
          this.pokemonsJugador2[indice] = Object.assign({}, pokemon);
        }
        this.cerrarModal();
      },

      abrirModal() {
        this.modalAbierto = true;
      },

      cerrarModal() {
        this.modalAbierto = false;
      },

      // Genera Pokémon aleatoriamente para cada equipo
      generarPokemonAleatorios() {
        this.pokemonsJugador1 = [];
        this.pokemonsJugador2 = [];
        let pokemonsDisponibles = [...this.todosLosPokemon];
        for (let i = 0; i < 5; i++) {
          let indiceAleatorio1 = Math.floor(Math.random() * pokemonsDisponibles.length);
          let p1 = Object.assign({}, pokemonsDisponibles[indiceAleatorio1]);
          p1.derrota = false;
          this.pokemonsJugador1.push(p1);
          pokemonsDisponibles.splice(indiceAleatorio1, 1);
          let indiceAleatorio2 = Math.floor(Math.random() * pokemonsDisponibles.length);
          let p2 = Object.assign({}, pokemonsDisponibles[indiceAleatorio2]);
          p2.derrota = false;
          this.pokemonsJugador2.push(p2);
          pokemonsDisponibles.splice(indiceAleatorio2, 1);
        }
      },

      // Vacía el tablero y reinicia las variables de la pelea
      vaciarTablero() {
        this.pokemonsJugador1 = Array.from({ length: 5 }, () => ({}));
        this.pokemonsJugador2 = Array.from({ length: 5 }, () => ({}));
        this.activePokemonJugador1 = null;
        this.activePokemonJugador2 = null;
        this.battleLog = [];
        this.battleModalAbierto = false;
      },

      // Inicia la pelea 1 al presionar "Comenzar Batalla"
      comenzarBatalla() {
        // Si algún equipo no tiene Pokémon asignados, se generan aleatoriamente
        if (!this.pokemonsJugador1.some(p => p.nombre) || !this.pokemonsJugador2.some(p => p.nombre)) {
          this.generarPokemonAleatorios();
        }
        // Se selecciona el primer Pokémon disponible (no derrotado) de cada equipo
        this.indexActivoJugador1 = this.pokemonsJugador1.findIndex(p => p.nombre && !p.derrota);
        this.indexActivoJugador2 = this.pokemonsJugador2.findIndex(p => p.nombre && !p.derrota);
        if (this.indexActivoJugador1 === -1 || this.indexActivoJugador2 === -1) {
          console.error("No hay Pokémon disponibles en ambos equipos.");
          return;
        }
        const p1 = this.pokemonsJugador1[this.indexActivoJugador1];
        const p2 = this.pokemonsJugador2[this.indexActivoJugador2];
        this.activePokemonJugador1 = Object.assign({}, p1);
        this.activePokemonJugador1.vida = this.obtenerEstadistica(p1, 'hp');
        this.activePokemonJugador2 = Object.assign({}, p2);
        this.activePokemonJugador2.vida = this.obtenerEstadistica(p2, 'hp');
        this.turno = 1;
        this.battleLog = [];
        this.batallaFinalizada = false;
        this.battleModalAbierto = true;
        this.simularPelea();
      },

      // Simula la pelea (fight 1) entre los Pokémon activos hasta que uno es derrotado
      async simularPelea() {
        while (this.activePokemonJugador1.vida > 0 && this.activePokemonJugador2.vida > 0) {
          await this.delay(1000);
          await this.atacarTurno();
        }
        // Se marca el Pokémon derrotado y se actualiza la carta con el dorso
        if (this.activePokemonJugador1.vida <= 0) {
          this.battleLog.push(`${this.activePokemonJugador1.nombre} ha sido derrotado!`);
          this.pokemonsJugador1[this.indexActivoJugador1].derrota = true;
        }
        if (this.activePokemonJugador2.vida <= 0) {
          this.battleLog.push(`${this.activePokemonJugador2.nombre} ha sido derrotado!`);
          this.pokemonsJugador2[this.indexActivoJugador2].derrota = true;
        }
        this.batallaFinalizada = true;
        // Se espera 2 segundos y se cierra el modal
        await this.delay(2000);
        this.cerrarBatallaModal();
      },

      // Ejecuta un turno de ataque: se elige aleatoriamente uno de dos movimientos válidos
      async atacarTurno() {
        let atacante, defensor;
        if (this.turno === 1) {
          atacante = this.activePokemonJugador1;
          defensor = this.activePokemonJugador2;
        } else {
          atacante = this.activePokemonJugador2;
          defensor = this.activePokemonJugador1;
        }
        const movimientos = await this.seleccionarDosMovimientos(atacante);
        if (movimientos.length < 2) {
          this.battleLog.push("No se encontraron movimientos válidos para " + atacante.nombre);
          return;
        }
        const indiceAleatorio = Math.floor(Math.random() * 2);
        const movimientoElegido = movimientos[indiceAleatorio];
        let defensa = this.obtenerEstadistica(defensor, 'defense');
        let damage = movimientoElegido.power - defensa;
        if (damage < 0) damage = 0;
        defensor.vida -= damage;
        this.battleLog.push(`${atacante.nombre} usa ${movimientoElegido.nombreAtaque} causando ${damage} puntos de daño a ${defensor.nombre}.`);
        if (defensor.vida <= 0) {
          this.battleLog.push(`${defensor.nombre} ha sido derrotado!`);
        }
        // Alterna el turno
        this.turno = this.turno === 1 ? 2 : 1;
      },

      // Extrae el valor base de la estadística solicitada (por ejemplo, "hp" o "defense")
      obtenerEstadistica(pokemon, statName) {
        const statObj = pokemon.stats ? pokemon.stats.find(s => s.stat.name === statName) : null;
        return statObj ? statObj.base_stat : 0;
      },

      // Obtiene el detalle de un movimiento a partir de su URL
      async obtenerDetalleMovimiento(url) {
        const res = await fetch(url);
        return await res.json();
      },

      // Selecciona dos movimientos válidos (con power distinto de null) de forma aleatoria para el Pokémon
      async seleccionarDosMovimientos(pokemon) {
        let movimientosValidos = [];
        let movesShuffled = pokemon.movimientos.slice();
        for (let i = movesShuffled.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
          [movesShuffled[i], movesShuffled[j]] = [movesShuffled[j], movesShuffled[i]];
        }
        for (let moveObj of movesShuffled) {
          try {
            let detalleMovimiento = await this.obtenerDetalleMovimiento(moveObj.move.url);
            if (detalleMovimiento.power !== null) {
              let nombreAtaque = (detalleMovimiento.names && detalleMovimiento.names[5])
                ? detalleMovimiento.names[5].name
                : detalleMovimiento.name;
              movimientosValidos.push({
                nombreAtaque: nombreAtaque,
                power: detalleMovimiento.power
              });
              if (movimientosValidos.length === 2) break;
            }
          } catch (error) {
            console.error("Error al obtener el detalle del movimiento", error);
          }
        }
        return movimientosValidos;
      },

      // Retardo para simular el paso del tiempo entre turnos
      delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
      },

      // Cierra el modal de pelea y reinicia las variables activas
      cerrarBatallaModal() {
        this.battleModalAbierto = false;
        this.activePokemonJugador1 = null;
        this.activePokemonJugador2 = null;
      }
    }
  });

  app.mount("#app");