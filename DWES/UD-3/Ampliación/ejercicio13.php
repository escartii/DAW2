<?php

/**
 * @Author: Álvaro Escartí
 */
function operaMatriz($matriz1, $matriz2, $operacion) {
    // Imprimir las matrices originales
    echo "Matriz 1:\n";
    imprimirMatriz($matriz1);
    echo "Matriz 2:\n";
    imprimirMatriz($matriz2);
    
    // Realizar la operación
    switch ($operacion) {
        case 's':
            $resultado = sumarMatrices($matriz1, $matriz2);
            $operacionTexto = "Suma";
            break;
        case 'r':
            $resultado = restarMatrices($matriz1, $matriz2);
            $operacionTexto = "Resta";
            break;
        case 'm':
            $resultado = multiplicarMatrices($matriz1, $matriz2);
            $operacionTexto = "Multiplicación";
            break;
        case 'd':
            $resultado = dividirMatrices($matriz1, $matriz2);
            $operacionTexto = "División";
            break;
        default:
            echo "Operación inválida";
            return;
    }
    
    // Imprimir la operación y el resultado
    echo "Operación: $operacionTexto\n";
    echo "Resultado:\n";
    imprimirMatriz($resultado);
}

function imprimirMatriz($matriz) {
    foreach ($matriz as $fila) {
        echo implode(" ", $fila) . "\n";
    }
}

function sumarMatrices($matriz1, $matriz2) {
    $filas = count($matriz1);
    $columnas = count($matriz1[0]);
    $resultado = array();
    
    for ($i = 0; $i < $filas; $i++) {
        $filaResultado = array();
        for ($j = 0; $j < $columnas; $j++) {
            $filaResultado[] = $matriz1[$i][$j] + $matriz2[$i][$j];
        }
        $resultado[] = $filaResultado;
    }
    
    return $resultado;
}

function restarMatrices($matriz1, $matriz2) {
    $filas = count($matriz1);
    $columnas = count($matriz1[0]);
    $resultado = array();
    
    for ($i = 0; $i < $filas; $i++) {
        $filaResultado = array();
        for ($j = 0; $j < $columnas; $j++) {
            $filaResultado[] = $matriz1[$i][$j] - $matriz2[$i][$j];
        }
        $resultado[] = $filaResultado;
    }
    
    return $resultado;
}

function multiplicarMatrices($matriz1, $matriz2) {
    $filas1 = count($matriz1);
    $columnas1 = count($matriz1[0]);
    $filas2 = count($matriz2);
    $columnas2 = count($matriz2[0]);
    
    if ($columnas1 != $filas2) {
        echo "No se pueden multiplicar las matrices";
        return;
    }
    
    $resultado = array();
    
    for ($i = 0; $i < $filas1; $i++) {
        $filaResultado = array();
        for ($j = 0; $j < $columnas2; $j++) {
            $elemento = 0;
            for ($k = 0; $k < $columnas1; $k++) {
                $elemento += $matriz1[$i][$k] * $matriz2[$k][$j];
            }
            $filaResultado[] = $elemento;
        }
        $resultado[] = $filaResultado;
    }
    
    return $resultado;
}

function dividirMatrices($matriz1, $matriz2) {
    $filas = count($matriz1);
    $columnas = count($matriz1[0]);
    $resultado = array();
    
    for ($i = 0; $i < $filas; $i++) {
        $filaResultado = array();
        for ($j = 0; $j < $columnas; $j++) {
            if ($matriz2[$i][$j] != 0) {
                $filaResultado[] = $matriz1[$i][$j] / $matriz2[$i][$j];
            } else {
                $filaResultado[] = "∞";
            }
        }
        $resultado[] = $filaResultado;
    }
    
    return $resultado;
}

// Ejemplo de uso
$matriz1 = array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 8, 9)
);

$matriz2 = array(
    array(9, 8, 7),
    array(6, 5, 4),
    array(3, 2, 1)
);

operaMatriz($matriz1, $matriz2, 'm');
?>