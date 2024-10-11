<?php

/**
 * @Author: Álvaro Escartí
 */


// Escribe un programa que diga cuál es la cifra que está en el centro (o las dos del centro si el
// número de cifras es par) de un número entero introducido por teclado.

function contarDigitos($num) {
    return strlen($num);
}

$numero = readline("introduce un numero: ");
$digitos = str_split($numero);
$numeroDeDigitos = contarDigitos($numero);
echo "Numero de digitos: " . $numeroDeDigitos . "\n";

echo "Numero en el medio: ";
if ($numeroDeDigitos % 2 == 0) {
    echo $digitos[($numeroDeDigitos / 2)-1];
}
echo $digitos[($numeroDeDigitos / 2)] . "\n";
?>