<?php

/**
 * @Author: Álvaro Escartí
 */
$array = [];
for ($i=0;$i < 3; $i++) { 
    $numers=readline("Escribe tres numeros: ");
    $array[$i] = [$numers];
}

echo "Antes de ordenar: \n";
var_dump($array);
arsort($array);
echo "Despues de ordenar: \n";
var_dump($array);
?>