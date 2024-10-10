<?php

/**
 * @Author: Álvaro Escartí
 */

$minimo = 1;
$maximo = 15;
$numeroRandom = rand($minimo, $maximo);

echo $numeroRandom . "\n";

$factorial = 1;
for ($i = 1; $i <= $numeroRandom; $i++) {
    $factorial *= $i;
}
echo "Numero factorial de: $numeroRandom es: $factorial\n";

?>