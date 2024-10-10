<?php

/**
 * @Author: Álvaro Escartí
 */


// Diseña un programa que determine la cantidad total a pagar por una llamada telefónica de
// acuerdo a las siguientes premisas: Toda llamada que dure menos de 3 minutos tiene un coste de
// 10 céntimos. Cada minuto adicional a partir de los 3 primeros es un paso de contador y cuesta 5 céntimos


$tiempoLlamada = readline("Dime cuanto tiempo ha durado tu llamada: ");
$precio = 0.10;
if ($tiempoLlamada < 3) {
    echo ("Precio de la llamada es: " . $precio . " euros\n");
}

if ($tiempoLlamada > 3) {
    $minutosAdicionales = $tiempoLlamada - 3;
    $costeAdicional = $minutosAdicionales * 0.05;
    $precioTotal = $precio + $costeAdicional;
    echo ("Precio de la llamada es: " . $precioTotal . " euros\n");
}
?>