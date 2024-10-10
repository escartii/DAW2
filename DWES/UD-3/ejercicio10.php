<?php

/**
 * @Author: Álvaro Escartí
 */

$minimo = 1;
$maximo = 20;

$numeroRandom = rand($minimo, $maximo);

echo $numeroRandom . "\n";

$sumatorio = 0;
for ($i = 1; $i <= $numeroRandom; $i++) {
    $sumatorio += $i;
}
echo "Numero factorial de: $numeroRandom es: $sumatorio\n";

?>