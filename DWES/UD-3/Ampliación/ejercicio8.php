<?php

/**
 * @Author: Álvaro Escartí
 */

// Declaro las variables
$arrayA = [];
$arrayB = [];
$arrayC = [];

// Pregunto 10 números al usuario para el array A
for ($i = 0; $i < 10; $i++) {
    $numero = readline("Ingresa un entero para el arrayA: ");
    array_push($arrayA, intval($numero));
}

// Pregunto 10 números al usuario para el array B
for ($i = 0; $i < 10; $i++) {
    $numero = readline("Ingresa un entero para el arrayB: "); // Corregido para leer $numero
    array_push($arrayB, intval($numero));
}

// Mezclar los arrays A y B en el arrayC
for ($i = 0; $i < 10; $i++) {
    $arrayC[] = $arrayA[$i];
    $arrayC[] = $arrayB[$i];
}

// Mostrar el arrayC mezclado
echo "ArrayC mezclado: " . implode(", ", $arrayC) . PHP_EOL;

?>
