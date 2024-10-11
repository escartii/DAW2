<?php

/**
 * @Author: Álvaro Escartí
 */


$numero = readline("Introduce un numero a comprobar: ");


if ($numero % 2 == 0) {
    echo "El numero: " . $numero . " Es par.\n";
}   

if ($numero % 3 == 0) {
    echo "El numero: " . $numero . " Es divisible entre 3.\n";
}


?>