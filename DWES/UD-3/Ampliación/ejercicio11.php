<?php

/**
 * @Author: Álvaro Escartí
 */


// Crear una tabla de 10x10
$tabla = array();
for ($i = 0; $i < 10; $i++) {
    $fila = array();
    for ($j = 0; $j < 10; $j++) {
        // Rellenar cada celda con un número aleatorio entre 1 y 100
        $fila[] = rand(1, 100);
    }
    $tabla[] = $fila;
}

// Mostrar la tabla y calcular la suma de cada fila
echo "Tabla:\n";
foreach ($tabla as $fila) {
    echo implode("\t", $fila) . "\n";
    $sumaFila = array_sum($fila);
    echo "Suma de la fila: $sumaFila\n";
}

// Calcular la suma de cada columna
$sumasColumna = array();
for ($j = 0; $j < 10; $j++) {
    $sumaColumna = 0;
    for ($i = 0; $i < 10; $i++) {
        $sumaColumna += $tabla[$i][$j];
    }
    $sumasColumna[] = $sumaColumna;
}

// Mostrar la suma de cada columna
echo "Sumas de las columnas:\n";
for ($j = 0; $j < 10; $j++) {
    echo "Suma de la columna $j: " . $sumasColumna[$j] . "\n";
}


?>