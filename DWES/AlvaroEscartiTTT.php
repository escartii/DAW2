<?php

/**
 * @Author: Álvaro Escartí
 * Modified version with tournament tracking
 */

// Función para inicializar el tablero vacío
function iniciarTablero() {
    $tablero = [];
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $tablero[$i][$j] = " ";
        }
    }
    return $tablero;
}

// Función para imprimir el tablero en formato tabla
function imprimirTablero($tablero) {
    echo "\n";
    for ($i = 0; $i < 3; $i++) {
        echo " " . $tablero[$i][0] . " | " . $tablero[$i][1] . " | " . $tablero[$i][2] . "\n";
        if ($i < 2) {
            echo "---|---|---\n";
        }
    }
    echo "\n";
}

// Función para verificar si el tablero está lleno (empate)
function tableroLleno($tablero) {
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($tablero[$i][$j] == " ") {
                return false;
            }
        }
    }
    return true;
}

// Función para verificar si un jugador ha ganado
function verificarGanador($tablero, $caracter) {
    // Verificar filas
    for ($i = 0; $i < 3; $i++) {
        if ($tablero[$i][0] == $caracter && $tablero[$i][1] == $caracter && $tablero[$i][2] == $caracter) {
            return true;
        }
    }

    // Verificar columnas
    for ($j = 0; $j < 3; $j++) {
        if ($tablero[0][$j] == $caracter && $tablero[1][$j] == $caracter && $tablero[2][$j] == $caracter) {
            return true;
        }
    }

    // Verificar diagonales
    if ($tablero[0][0] == $caracter && $tablero[1][1] == $caracter && $tablero[2][2] == $caracter) {
        return true;
    }

    if ($tablero[0][2] == $caracter && $tablero[1][1] == $caracter && $tablero[2][0] == $caracter) {
        return true;
    }

    return false;
}

// Función para configurar los jugadores
function configurarJugadores(&$jugador1, &$jugador2) {
    // Configurar Jugador 1
    if (empty($jugador1['nombre'])) {
        $jugador1['nombre'] = readline("Nombre de Jugador1: ");
        do {
            $car1 = trim(readline("Carácter para {$jugador1['nombre']}: "));
            if (strlen($car1) === 1) {
                $jugador1['caracter'] = strtoupper($car1);
                break;
            }
            echo "Introduce solo un carácter.\n";
        } while (true);
    }

    // Configurar Jugador 2
    if (empty($jugador2['nombre'])) {
        $jugador2['nombre'] = readline("Nombre de Jugador2: ");
        do {
            $car2 = trim(readline("Carácter para {$jugador2['nombre']} (diferente de {$jugador1['caracter']}): "));
            if (strlen($car2) !== 1) {
                echo "Introduce solo un carácter.\n";
                continue;
            }
            if (strtoupper($car2) === strtoupper($jugador1['caracter'])) {
                echo "Carácter ya usado por {$jugador1['nombre']}. Elige otro.\n";
                continue;
            }
            $jugador2['caracter'] = strtoupper($car2);
            break;
        } while (true);
    }
}

// Función para iniciar una partida
function iniciarPartida(&$jugador1, &$jugador2, &$victoriasTorneo1, &$victoriasTorneo2) {
    $tablero = iniciarTablero();
    $turno = 1; // 1 para Jugador1, 2 para Jugador2

    while (true) {
        imprimirTablero($tablero);
        $jugador = $turno === 1 ? $jugador1 : $jugador2;
        echo "Turno de {$jugador['nombre']} ({$jugador['caracter']})\n";

        // Solicitar fila y columna o abandono
        $entradaFila = strtoupper(trim(readline("Introduce la fila (1-3) o 'S' para abandonar: ")));
        if ($entradaFila === 'S') {
            // El jugador abandona
            $oponente = $turno === 1 ? $jugador2['nombre'] : $jugador1['nombre'];
            echo "{$jugador['nombre']} ha abandonado la partida. {$oponente} gana la partida.\n";
            if ($turno === 1) {
                $victoriasTorneo2++;
                $jugador2['victorias']++;
                $jugador1['derrotas']++;
            } else {
                $victoriasTorneo1++;
                $jugador1['victorias']++;
                $jugador2['derrotas']++;
            }
            return;
        }

        $fila = intval($entradaFila) - 1;

        $entradaColumna = strtoupper(trim(readline("Introduce la columna (1-3) o 'S' para abandonar: ")));
        if ($entradaColumna === 'S') {
            // El jugador abandona
            $oponente = $turno === 1 ? $jugador2['nombre'] : $jugador1['nombre'];
            echo "{$jugador['nombre']} ha abandonado la partida. {$oponente} gana la partida.\n";
            if ($turno === 1) {
                $victoriasTorneo2++;
                $jugador2['victorias']++;
                $jugador1['derrotas']++;
            } else {
                $victoriasTorneo1++;
                $jugador1['victorias']++;
                $jugador2['derrotas']++;
            }
            return;
        }

        $columna = intval($entradaColumna) - 1;

        // Validar entrada
        if ($fila < 0 || $fila > 2 || $columna < 0 || $columna > 2) {
            echo "Fila o columna inválida. Intenta de nuevo.\n";
            continue;
        }

        if ($tablero[$fila][$columna] !== " ") {
            echo "Posición ocupada. Intenta de nuevo.\n";
            continue;
        }

        // Asignar el carácter al tablero
        $tablero[$fila][$columna] = $jugador['caracter'];

        // Verificar ganador
        if (verificarGanador($tablero, $jugador['caracter'])) {
            imprimirTablero($tablero);
            echo "¡{$jugador['nombre']} ha ganado la partida!\n";
            if ($turno === 1) {
                $victoriasTorneo1++;
                $jugador1['victorias']++;
                $jugador2['derrotas']++;
            } else {
                $victoriasTorneo2++;
                $jugador2['victorias']++;
                $jugador1['derrotas']++;
            }
            return;
        }

        // Verificar empate
        if (tableroLleno($tablero)) {
            imprimirTablero($tablero);
            echo "¡Empate!\n";
            return;
        }

        // Cambiar turno
        $turno = $turno === 1 ? 2 : 1;
    }
}

// Función para jugar un torneo (ganar 3 partidas)
function jugarTorneo(&$jugador1, &$jugador2) {
    echo "\n=== Inicio del Torneo ===\n";
    $victoriasTorneo1 = 0;
    $victoriasTorneo2 = 0;
    $partidaActual = 1;

    // Continuar jugando hasta que un jugador gane 3 partidas
    while ($victoriasTorneo1 < 3 && $victoriasTorneo2 < 3) {
        echo "\n=== Partida $partidaActual ===\n";
        iniciarPartida($jugador1, $jugador2, $victoriasTorneo1, $victoriasTorneo2);

        // Mostrar resultados intermedios
        echo "\n=== Resultados del torneo hasta ahora ===\n";
        echo "{$jugador1['nombre']}: Victorias dentro del torneo: {$victoriasTorneo1}, Total victorias: {$jugador1['victorias']}, Derrotas: {$jugador1['derrotas']}, Copas: {$jugador1['copas']}\n";
        echo "{$jugador2['nombre']}: Victorias dentro del torneo: {$victoriasTorneo2}, Total victorias: {$jugador2['victorias']}, Derrotas: {$jugador2['derrotas']}, Copas: {$jugador2['copas']}\n";

        $partidaActual++;
    }

    // Determinar el ganador del torneo
    if ($victoriasTorneo1 === 3) {
        echo "\n=== ¡{$jugador1['nombre']} ha ganado el torneo y obtiene una copa! ===\n";
        $jugador1['copas']++;
    } elseif ($victoriasTorneo2 === 3) {
        echo "\n=== ¡{$jugador2['nombre']} ha ganado el torneo y obtiene una copa! ===\n";
        $jugador2['copas']++;
    }

    // Mostrar estadísticas finales del torneo
    echo "\n=== Estadísticas Finales del Torneo ===\n";
    echo "{$jugador1['nombre']}: Total victorias: {$jugador1['victorias']}, Derrotas: {$jugador1['derrotas']}, Copas: {$jugador1['copas']}\n";
    echo "{$jugador2['nombre']}: Total victorias: {$jugador2['victorias']}, Derrotas: {$jugador2['derrotas']}, Copas: {$jugador2['copas']}\n";
}

// Función para mostrar el menú principal
function mostrarMenu() {
    echo "\n=== Menú de Tres en Raya ===\n";
    echo "1. Iniciar un nuevo torneo\n";
    echo "S. Salir\n";
    echo "Elige una opción: ";
}

// Función para preguntar al usuario si quiere jugar otro torneo
function preguntarJugarOtro() {
    do {
        $respuesta = strtoupper(trim(readline("¿Deseas jugar otro torneo? (S/N): ")));
        if ($respuesta === 'S' || $respuesta === 'N') {
            return $respuesta;
        }
        echo "Respuesta inválida. Por favor, ingresa 'S' para sí o 'N' para no.\n";
    } while (true);
}

// Inicializar estadísticas de los jugadores
$jugador1 = ["nombre" => "", "caracter" => "", "victorias" => 0, "derrotas" => 0, "copas" => 0];
$jugador2 = ["nombre" => "", "caracter" => "", "victorias" => 0, "derrotas" => 0, "copas" => 0];

// Bucle principal del programa
$continuar = true;

do {
    mostrarMenu();
    $opcion = strtoupper(trim(readline()));

    switch ($opcion) {
        case '1':
            configurarJugadores($jugador1, $jugador2);
            jugarTorneo($jugador1, $jugador2);
            $respuesta = preguntarJugarOtro();
            if ($respuesta === 'S') {
                // Mantener las estadísticas totales y copas, solo reiniciar para el nuevo torneo
                echo "\nIniciando un nuevo torneo...\n";
            } else {
                echo "Saliendo del juego. ¡Hasta luego!\n";
                $continuar = false;
            }
            break;
        case 'S':
            echo "Saliendo del juego. ¡Hasta luego!\n";
            $continuar = false;
            break;
        default:
            echo "Opción inválida. Elige una opción válida.\n";
            break;
    }
} while ($continuar);

?>