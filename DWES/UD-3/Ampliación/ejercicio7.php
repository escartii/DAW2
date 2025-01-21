<?php

/**
 * @Author: Álvaro Escartí
 */

// Declarar los arrays
$hora = ["14:10", "15:05", "16:00", "16:55", "17:15", "18:10", "19:05","20:00"];
$cuadrado = [];
$cubo = [];

// Generar números aleatorios y almacenarlos en el array $numero
for ($i = 0; $i < 7; $i++) {
    $hora[$i] = rand(1,60);
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
echo "Hora\t| Miercoles\t| Martes\t| Miercoles\t| Jueves\t| Viernes\n";
echo "-------\t| ---------\t| ----\n";
for ($i = 0; $i < 20; $i++) {
    echo $numero[$i] . "\t| " . $cuadrado[$i] . "\t\t| " . $cubo[$i] . "\n";
}
?>