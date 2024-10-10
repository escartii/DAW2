<?php

/**
 * @Author: Álvaro Escartí
 */

$numero = readline("introduce un numero para mostrar su tabla de multiplicar: ");
for ($i = 0; $i <= 10; $i++) {
    echo ($numero . "x" . $i . "=". $numero * $i ."\n");
}

$factorial = 1;


?>