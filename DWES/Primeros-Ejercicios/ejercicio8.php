<?php

/**
 * @Author: Álvaro Escartí
 */

$saberDia=date("d");
echo $saberDia."\n";

if ($saberDia <= 15) {
    echo "Primera quincena\n";
} else {
    echo "Segunda quincena\n";
}

?>