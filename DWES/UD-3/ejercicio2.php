<?php

/**
 * @Author: Álvaro Escartí
 */


echo "Hoy es: " . date("Y/m/d") . "\n";
echo "Hora actual: " . date("H:i:s") . "\n";

if (date("l") == "Monday") {
    echo "Lunes\n";
} else if (date("l") == "Tuesday") {
    echo "Martes\n";
} else if (date("l") == "Wednesday") {
    echo "Miércoles\n";
} else if (date("l") == "Thursday") {
    echo "Jueves\n";
} else if (date("l") == "Friday") {
    echo "Viernes\n";
} else if (date("l") == "Saturday") {
    echo "Sábado\n";
} else if (date("l") == "Sunday") {
    echo "Domingo\n";
}

?>