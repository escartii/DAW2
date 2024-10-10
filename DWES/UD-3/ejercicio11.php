<?php

/**
 * @Author: Álvaro Escartí
 */


$comprobarNumero = readline("Introduce un numero: ");

for ($i=0; $i < $comprobarNumero; $i++) { 
    if ($i %2 == 1) {
        echo ("Numero impar: " .$i . "\n");
    }
}
?>