<?php

$array = [];
for ($i=0; $i < 5; $i++) { 
    $numeros = readline("Introduce un numero (separados por coma): ");
    array_push($array, $numeros);
}

// Función para sumar los valores dentro del Array
$totalSuma = array_sum($array);
// Función para sacar la media
$numerosEnArray = count($array);

$totalResultado = ("Media del Array: " . $totalSuma / $numerosEnArray ."\n");

echo $totalResultado;
$redondear = round($totalResultado);
echo $redondear;

?>

