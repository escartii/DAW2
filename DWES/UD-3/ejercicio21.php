<?php

/**
* @Author: Álvaro Escartí
*/


function comprobarDigitos($numero){
    if ($numero >= 99999) {
        return false;
    } else {
        return true;
    }
}

function contarDigitos($numero) {
    return strlen($numero);
}

function penultimoNumero($numero) {
    $digitos = str_split($numero);
    $numeroDeDigitos = contarDigitos($numero);
    return $digitos[$numeroDeDigitos - 2];
}

$numero = readline("introduce un número: ");

if (comprobarDigitos($numero)) {
    $digitos = str_split($numero);
    $numeroDeDigitos = contarDigitos($numero);
    $penultimo = penultimoNumero($numero);
    echo "El penúltimo número del número introducido es: " . $penultimo . "\n";
} else {
    echo "Número no válido\n";
}

?>