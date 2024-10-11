<?php

/**
* @Author: Álvaro Escartí
*/
 
function elevarNumeros($numero1, $numero2){
    $resultado = pow($numero1, $numero2); // Eleva el número1 a la potencia de número2
    return $resultado;
}

echo "El resultado es: " . elevarNumeros(4,5) . "\n";
?>