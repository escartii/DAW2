<?php

/**
 * @Author: Álvaro Escartí
 */

// Declarar los arrays
$numero = [];
$cuadrado = [];
$cubo = [];

// Generar números aleatorios y almacenarlos en el array $numero
for ($i = 0; $i < 20; $i++) {
    $numero[$i] = rand(0, 100);
}

// Calcular el cuadrado de cada número y almacenarlos en el array $cuadrado
foreach ($numero as $num) {
    $cuadrado[] = $num ** 2;
}

// Calcular el cubo de cada número y almacenarlos en el array $cubo
foreach ($numero as $num) {
    $cubo[] = $num ** 3;
}

// Mostrar el contenido de los tres arrays en tres columnas
echo "Numero\t| Cuadrado\t| Cubo\n";
echo "-------\t| ---------\t| ----\n";
for ($i = 0; $i < 20; $i++) {
    echo $numero[$i] . "\t| " . $cuadrado[$i] . "\t\t| " . $cubo[$i] . "\n";
}
?>