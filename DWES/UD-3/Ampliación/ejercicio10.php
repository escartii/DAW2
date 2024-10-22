<?php

/**
 * @Author: Álvaro Escartí
 */

// Crear y rellenar por teclado dos matrices de tamaño 3x3, sumarlas y mostrar su suma
$tamano = array();
$matriz1 = array();
$matriz2 = array();
$suma = array();

// Rellenar la primera matriz
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $matriz1[$i][$j] = readline("Introduce un número para la matriz1: ");
    }
}

// Rellenar la segunda matriz
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $matriz2[$i][$j] = readline("Introduce un número para la matriz2: ");
    }
}

// Sumar las matrices
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $suma[$i][$j] = $matriz1[$i][$j] + $matriz2[$i][$j];
    }
}

// Mostrar la suma
echo "La suma de las matrices es:\n";
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        echo $suma[$i][$j] . " ";
    }
    echo "\n";
}



?>