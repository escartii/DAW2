<?php

/**
 * @Author: Álvaro Escartí
 */


// Dado un vector asociativo de trabajadores con su salario creado solicitando al usuario el nombre
// y salario de cada trabajador, crea usando funciones el salario máximo, el salario mínimo y el
// salario medio

// Función para calcular el salario máximo
function calcularSalarioMaximo($trabajadores) {
    $salarios = array_column($trabajadores, 'salario');
    return max($salarios);
}

// Función para calcular el salario mínimo
function calcularSalarioMinimo($trabajadores) {
    $salarios = array_column($trabajadores, 'salario');
    return min($salarios);
}

// Función para calcular el salario medio
function calcularSalarioMedio($trabajadores) {
    $salarios = array_column($trabajadores, 'salario');
    $totalSalarios = array_sum($salarios);
    $numTrabajadores = count($trabajadores);
    return $totalSalarios / $numTrabajadores;
}

// Solicitar al usuario el nombre y salario de cada trabajador
$trabajadores = [];
$numTrabajadores = (int) readline('Introduce el número de trabajadores: ');

for ($i = 1; $i <= $numTrabajadores; $i++) {
    $nombre = readline("Introduce el nombre del trabajador $i: ");
    $salario = (float) readline("Introduce el salario del trabajador $i: ");
    $trabajadores[] = ['nombre' => $nombre, 'salario' => $salario];
}

// Calcular el salario máximo, mínimo y medio
$salarioMaximo = calcularSalarioMaximo($trabajadores);
$salarioMinimo = calcularSalarioMinimo($trabajadores);
$salarioMedio = calcularSalarioMedio($trabajadores);

// Mostrar los resultados
echo "Salario máximo: $salarioMaximo" . "\n";
echo "Salario mínimo: $salarioMinimo" . "\n";
echo "Salario medio: $salarioMedio" . "\n";

?>