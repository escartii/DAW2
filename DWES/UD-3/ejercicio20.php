<?php

/**
 * @Author: Álvaro Escartí
 */

function devolverArrayReves($array){
    return array_reverse($array);
}

$numero = readline("Introduce un numero: ");
$array = str_split($numero);

$resultado = devolverArrayReves($array);
echo implode("", $resultado) . "\n";

?>