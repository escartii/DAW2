<?php

/**
 * @Author: Álvaro Escartí
 */


 // Realiza un programa que nos diga cuántos dígitos tiene un número dado

function contarDigitos($num) {
    return strlen($num);
}

$numero = readline("introduce un numero: ");
$numeroDeDigitos = contarDigitos($numero);
echo "Numero de digitos: " . $numeroDeDigitos . "\n";
?>