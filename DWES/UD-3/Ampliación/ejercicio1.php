<?php

/**
* @Author: Álvaro Escartí
*/

$minimo = 1;
$maximo = 7;
$diaSemana = rand($minimo, $maximo);

switch ($diaSemana) {
    case 1:
        echo "Lunes\n";
        break;
    case 2:
        echo "Martes\n";
        break;
    case 3: 
        echo "Miércoles\n";
        break;
    case 4:
        echo "Jueves\n";
        break;
    case 5:
        echo "Viernes\n";
        break;
    case 6:
        echo "Sábado\n";
        break;
    case 7:
        echo "Domingo\n";
        break;
}
?>