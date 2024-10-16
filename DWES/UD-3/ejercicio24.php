<?php

/**
 * @Author: Álvaro Escartí
 */

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
    return $numTrabajadores > 0 ? $totalSalarios / $numTrabajadores : 0;
}

// Función para calcular el salario aumentado
function calcularSalarioAumentado($trabajadores, $porcentaje) {
    foreach ($trabajadores as &$trabajador) {
        $trabajador['salarioAumentado'] = $trabajador['salario'] * (1 + $porcentaje / 100);
    }
    return $trabajadores;
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

// Solicitar el porcentaje de aumento
$porcentaje = (float) readline("Introduce el porcentaje de aumento: ");

// Calcular los salarios aumentados
$trabajadoresConAumento = calcularSalarioAumentado($trabajadores, $porcentaje);

// Mostrar los salarios actuales y aumentados
foreach ($trabajadoresConAumento as $trabajador) {
    echo "Trabajador: {$trabajador['nombre']}, Salario Actual: {$trabajador['salario']}, Salario Aumentado: {$trabajador['salarioAumentado']}" . "\n";
}

?>
