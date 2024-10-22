<?php

/**
 * @Author: Álvaro Escartí
 */

$numbers = [];
$sum = 0;

while ($sum < 1000) {
    $input = readline("Ingresa un número: ");
    $number = intval($input);
    
    $numbers[] = $number;
    $sum += $number;
}

$count = count($numbers);
$average = $sum / $count;

echo "Números ingresados: " . implode(", ", $numbers) . "\n";
echo "Total de números: " . $count . "\n";
echo "Suma: " . $sum . "\n";
echo "Promedio: " . $average . "\n";

?>