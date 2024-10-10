<?php

/**
 * @Author: Álvaro Escartí
 */


$tiempo = readline("Introduce un tiempo en segundos: ");

$horas = floor($tiempo / 3600);
$minutos = floor(($tiempo % 3600) / 60);
$segundos = $tiempo % 60;

echo "Tiempo de entrada: " . $tiempo . " segundos\n";
echo "Tiempo convertido: " . $horas . " horas, " . $minutos . " minutos, " . $segundos . " segundos\n";


?>