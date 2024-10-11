<?php

/**
 * @Author: Álvaro Escartí
 */


function calcularPotencias($numero, $exponente) {
    $potencias = [];
    $suma = 0;

    for ($i = 0; $i <= $exponente; $i++) {
        $potencia = pow($numero, $i);
        $potencias[] = $potencia;
        $suma += $potencia;
        echo "Potencia de $numero elevado a $i: $potencia\n";
    }

    echo "Suma de todas las potencias: $suma\n";

    return $potencias;
}

$numero = 2;
$exponente = 5;
$resultado = calcularPotencias($numero, $exponente);

?>