<?php

/**
 * @Author: Álvaro Escartí
 */

// Escribe un programa que lea tres números positivos y compruebe si son iguales. Por ejemplo:
// * Si la entrada fuese 5 5 5, la salida debería ser “hay tres números iguales a 5“.
// * Si la entrada fuese 4 6 4, la salida debería ser “hay dos números iguales a 4“.
// * Si la entrada fuese 0 1 2, la salida debería ser “no hay números iguales“

$numeros = readline("Escribe tres numeros: ");
$array = explode(" ", $numeros);

// Compruebo que el array tenga 3 numeros
if (count($array) >= 3) {
    if ($array[0] == $array[1] && $array[1] == $array[2]) {
        echo "hay tres números iguales a " . $array[0] . "\n";
    } elseif ($array[0] == $array[1] || $array[1] == $array[2] || $array[0] == $array[2]) {
        $count = count(array_unique($array));
        echo "hay dos números iguales a " . $array[0] . " (" . $count . ")\n";
    } else {
        echo "no hay números iguales\n";
    }
} else {
    echo "Debes ingresar al menos tres números\n";
}

?>