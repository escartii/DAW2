<?php

/**
* @Author: Álvaro Escartí
*/


// Escribe un programa que lea una lista de diez números y determine cuántos son positivos, y
// cuántos son negativos (muestra los números, la cantidad de positivos y negativos y el porcentaje
// de cada grupo).

$listDeNumeros = [1,2,3,4,-5,6,7,8,9,10];
$positivos = 0;
$negativos = 0;

foreach ($listDeNumeros as $numero) {
    if ($numero > 0) {
        $positivos++;
    } elseif ($numero < 0) {
        $negativos++;
    }
}

$totalNumeros = count($listDeNumeros);
$porcentajePositivos = ($positivos / $totalNumeros) * 100;
$porcentajeNegativos = ($negativos / $totalNumeros) * 100;

echo "Números: " . implode(", ", $listDeNumeros) . "\n";
echo "Cantidad de positivos: " . $positivos . "\n";
echo "Cantidad de negativos: " . $negativos . "\n";
echo "Porcentaje de positivos: " . $porcentajePositivos . "%\n";
echo "Porcentaje de negativos: " . $porcentajeNegativos . "%\n";
?>
