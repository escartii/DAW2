<?php

/**
 * @Author: Álvaro Escartí
 */

// Realiza un programa que pida 8 números enteros, los almacene en un vector junto con la
// palabra “par” o “impar” según proceda y los muestre. Además debe indicar la cantidad de
// números en cada caso y el porcentaje de pares e impares.

$numeros = [];
for ($i = 0; $i < 8; $i++) { 
    $numero = readline("Escribe un numero: ");
    $numeros[] = [
        'numero' => $numero,
        'tipo' => ($numero % 2 == 0) ? 'par' : 'impar'
    ];
}

$pares = 0;
$impares = 0;

foreach ($numeros as $num) {
    echo "Número: " . $num['numero'] . " - " . $num['tipo'] . "\n";
    if ($num['tipo'] == 'par') {
        $pares++;
    } else {
        $impares++;
    }
}

$total = count($numeros);
$porcentajePares = ($pares / $total) * 100;
$porcentajeImpares = ($impares / $total) * 100;

echo "Cantidad de números pares: $pares\n";
echo "Cantidad de números impares: $impares\n";
echo "Porcentaje de números pares: $porcentajePares%\n";
echo "Porcentaje de números impares: $porcentajeImpares%\n";

?>
