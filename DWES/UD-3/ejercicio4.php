<?php

/**
 * @Author: Álvaro Escartí
 */



$tiempo = readline("Dime HH:MM:SS: ");

list($horas, $minutos, $segundos) = explode(':', $tiempo);

if (is_numeric($horas) && is_numeric($minutos) && is_numeric($segundos) && $horas >= 0 && $horas <= 23 && $minutos >= 0 && $minutos <= 59 && $segundos >= 0 && $segundos <= 59) {
    echo "La hora está correctamente expresada.\n";
} else {
    echo "La hora no está correctamente expresada.\n";
}

?>