<?php

/**
 * @Author: Álvaro Escartí
 */

// Declarar el array asociativo para los módulos de cada día
$horario = [
    "14:10" => ["lunes" => "DWEC", "martes" => "DWEC", "miércoles" => "--", "jueves" => "DWES", "viernes" => "EIE"],
    "15:05" => ["lunes" => "DWEC", "martes" => "DWEC", "miércoles" => "DWEC", "jueves" => "DWES", "viernes" => "DWES"],
    "16:00" => ["lunes" => "DWES", "martes" => "DIW", "miércoles" => "DWEC", "jueves" => "EIE", "viernes" => "DWES"],
    "16:55" => ["lunes" => "P", "martes" => "A", "miércoles" => "T", "jueves" => "I", "viernes" => "O"],
    "17:15" => ["lunes" => "DWES", "martes" => "DIW", "miércoles" => "DWEC", "jueves" => "DIW", "viernes" => "DIW"],
    "18:10" => ["lunes" => "EIE", "martes" => "DWES", "miércoles" => "DAW", "jueves" => "DIW", "viernes" => "DIW"],
    "19:05" => ["lunes" => "DAW", "martes" => "DWES", "miércoles" => "DAW", "jueves" => "DAW", "viernes" => ""],
    "20:00" => ["lunes" => "DAM", "martes" => "", "miércoles" => "TUT", "jueves" => "DAW", "viernes" => ""]
];

printf("%-8s | %-10s | %-10s | %-12s | %-10s | %-10s\n", "Hora", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes");
echo "---------|------------|------------|--------------|------------|----------\n";

foreach ($horario as $hora => $modulos) {
    printf(
        "%-8s | %-10s | %-10s | %-12s | %-10s | %-10s\n",
        $hora,
        $modulos["lunes"],
        $modulos["martes"],
        $modulos["miércoles"],
        $modulos["jueves"],
        $modulos["viernes"]
    );
}

?>
