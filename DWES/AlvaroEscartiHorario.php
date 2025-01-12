<?php

/**
 * @Author: Álvaro Escartí
 */

// Declarar los arrays de horas y módulos para cada día
$hora = ["14:10", "15:05", "16:00", "16:55", "17:15", "18:10", "19:05", "20:00"];
$lunes = ["DWEC", "DWEC", "DWES", "P", "DWES", "EIE", "DAW", "DAM"];
$martes = ["DWEC", "DWEC", "DIW", "A", "DIW", "DWES", "DWES"];
$miercoles = ["--", "DWEC", "DWEC", "T", "DWEC", "DAW", "DAW", "TUT"];
$jueves = ["DWES", "DWES", "EIE", "I", "DIW", "DIW", "DAW", "DAW"];
$viernes = ["EIE", "DWES", "DWES", "O", "DIW", "DIW"];


$totalHoras = count($hora);
printf("%-8s | %-10s | %-10s | %-12s | %-10s | %-10s\n", "Hora", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes");
echo "---------|------------|------------|--------------|------------|----------\n";

for ($i = 0; $i < $totalHoras; $i++) {
    $moduloLunes = isset($lunes[$i]) ? $lunes[$i] : "";
    $moduloMartes = isset($martes[$i]) ? $martes[$i] : "";
    $moduloMiercoles = isset($miercoles[$i]) ? $miercoles[$i] : "";
    $moduloJueves = isset($jueves[$i]) ? $jueves[$i] : "";
    $moduloViernes = isset($viernes[$i]) ? $viernes[$i] : "";
    
    printf(
        "%-8s | %-10s | %-10s | %-12s | %-10s | %-10s\n",
        $hora[$i],
        $moduloLunes,
        $moduloMartes,
        $moduloMiercoles,
        $moduloJueves,
        $moduloViernes
    );
}

?>
