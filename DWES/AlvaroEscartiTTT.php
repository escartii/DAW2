<?php

/**
 * @Author: Álvaro Escartí
 */

// Función para iniciar el tablero vacío
function iniciarTablero()
{
    $tablero = [];

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $tablero[$i][$j] = " ";
        }
    }
    return $tablero;
}

// Función para imprimir el tablero
function imprimirTablero($tablero)
{
    echo "\n";
    for ($i = 0; $i < 3; $i++) {
        echo " " . $tablero[$i][0] . " | " . $tablero[$i][1] . " | " . $tablero[$i][2] . "\n";
        if ($i < 2) {
            echo "---|---|---\n";
        }
    }
    echo "\n";
}

// Función para verificar si el tablero está lleno
function tableroLleno($tablero)
{
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($tablero[$i][$j] == " ") {
                return false;
            }
        }
    }
    return true;
}

// Función para verificar si hay un ganador
function verificarGanador($tablero, $caracter)
{
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

// Función para iniciar una partida
function iniciarPartida(&$jugador1, &$jugador2)
{
    $tablero = iniciarTablero();
    $turno = 1; // 1 para jugador1, 2 para jugador2
    $ganador = false;

    while (true) {
        imprimirTablero($tablero);
        if ($turno == 1) {
            echo "Turno de " . $jugador1['nombre'] . " (" . $jugador1['caracter'] . ")\n";
            $posicion = readline("Introduce la posición (1-9): ");
            $fila = intval(($posicion - 1) / 3);
            $columna = intval(($posicion - 1) % 3);
            if ($posicion < 1 || $posicion > 9 || $tablero[$fila][$columna] != " ") {
                echo "Posición inválida. Intenta de nuevo.\n";
                continue;
            }
            $tablero[$fila][$columna] = $jugador1['caracter'];
            if (verificarGanador($tablero, $jugador1['caracter'])) {
                imprimirTablero($tablero);
                echo "¡" . $jugador1['nombre'] . " ha ganado!\n";
                $jugador1['victorias']++;
                $jugador2['derrotas']++;
                break;
            }
            $turno = 2;
        } else {
            echo "Turno de " . $jugador2['nombre'] . " (" . $jugador2['caracter'] . ")\n";
            $posicion = readline("Introduce la posición (1-9): ");
            $fila = intval(($posicion - 1) / 3);
            $columna = intval(($posicion - 1) % 3);
            if ($posicion < 1 || $posicion > 9 || $tablero[$fila][$columna] != " ") {
                echo "Posición inválida. Intenta de nuevo.\n";
                continue;
            }
            $tablero[$fila][$columna] = $jugador2['caracter'];
            if (verificarGanador($tablero, $jugador2['caracter'])) {
                imprimirTablero($tablero);
                echo "¡" . $jugador2['nombre'] . " ha ganado!\n";
                $jugador2['victorias']++;
                $jugador1['derrotas']++;
                break;
            }
            $turno = 1;
        }

        if (tableroLleno($tablero)) {
            imprimirTablero($tablero);
            echo "¡Empate!\n";
            break;
        }
    }
}

// Función para mostrar el menú
function mostrarMenu()
{
    echo "=== Menú de Tres en Raya ===\n";
    echo "1. Iniciar una nueva partida\n";
    echo "2. Ver puntuaciones\n";
    echo "S. Salir\n";
    echo "Elige una opción: ";
}

// Función principal para manejar el menú
function principal()
{
    // Inicializar estadísticas de los jugadores
    $jugador1 = array(
        "nombre" => "",
        "caracter" => "",
        "victorias" => 0,
        "derrotas" => 0
    );

    $jugador2 = array(
        "nombre" => "",
        "caracter" => "",
        "victorias" => 0,
        "derrotas" => 0
    );

    do {
        mostrarMenu();
        $opcion = strtoupper(trim(readline()));

        switch ($opcion) {
            case '1':
                // Si los nombres y caracteres no están definidos, solicitarlos
                if (empty($jugador1['nombre']) || empty($jugador1['caracter']) || empty($jugador2['nombre']) || empty($jugador2['caracter'])) {
                    echo "Configura los jugadores:\n";
                    $jugador1['nombre'] = readline("Introduce el nombre de Jugador1: ");
                    do {
                        $caracter1 = readline("¿Qué carácter quieres usar para $jugador1[nombre]? (X/O): ");
                        $caracter1 = strtoupper(trim($caracter1));
                        if ($caracter1 == 'X' || $caracter1 == 'O') {
                            $jugador1['caracter'] = $caracter1;
                            break;
                        } else {
                            echo "Carácter inválido. Solo se permiten 'X' u 'O'.\n";
                        }
                    } while (true);

                    $jugador2['nombre'] = readline("Introduce el nombre de Jugador2: ");
                    // Asegurar que el jugador2 use el carácter opuesto
                    $jugador2['caracter'] = ($jugador1['caracter'] == 'X') ? 'O' : 'X';
                    echo "$jugador2[nombre] usará el carácter " . $jugador2['caracter'] . "\n";
                }

                iniciarPartida($jugador1, $jugador2);
                break;

            case '2':
                echo "\n=== Puntuaciones ===\n";
                echo $jugador1['nombre'] . " - Victorias: " . $jugador1['victorias'] . " | Derrotas: " . $jugador1['derrotas'] . "\n";
                echo $jugador2['nombre'] . " - Victorias: " . $jugador2['victorias'] . " | Derrotas: " . $jugador2['derrotas'] . "\n\n";
                break;

            case 'S':
                echo "Saliendo del juego. ¡Hasta luego!\n";
                break;

            default:
                echo "Opción inválida. Por favor, elige una opción válida.\n";
                break;
        }

    } while ($opcion !== 'S');
}

// Ejecutar la función principal
principal();
?>
