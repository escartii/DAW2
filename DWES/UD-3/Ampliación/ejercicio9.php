<?php
/**
 * @Author: Álvaro Escartí
 */

// Definir el tamaño de la matriz
$tamano = 5;

// Inicializar la matriz
$matriz = array();

// Rellenar la matriz
for ($n = 0; $n < $tamano; $n++) {
    for ($m = 0; $m < $tamano; $m++) {
        $matriz[$n][$m] = $n + $m;
    }
}

// Mostrar la matriz
for ($n = 0; $n < $tamano; $n++) {
    for ($m = 0; $m < $tamano; $m++) {
        echo $matriz[$n][$m] . " ";
    }
    echo "\n";
}
