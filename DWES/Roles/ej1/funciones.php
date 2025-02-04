<?php
// Definir el array asociativo de trabajadores con sus salarios
$trabajadores = [
    "Alvaro" => 3000,
    "Marc" => 3000,
    "Javi" => 999,
    "Jorge" => 1800,
    "Antonio" => 5300
];

// Función para calcular el salario máximo
function salarioMaximo($trabajadores) {
    return max($trabajadores);
}

// Función para calcular el salario mínimo
function salarioMinimo($trabajadores) {
    return min($trabajadores);
}

// Función para calcular el salario medio
function salarioMedio($trabajadores) {
    return array_sum($trabajadores) / count($trabajadores);
}
?>