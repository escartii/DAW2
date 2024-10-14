<?php

/**
* @Author: Álvaro Escartí
*/

$notas = [];

for ($i = 1; $i <= 7; $i++) {
    $nota = readline("Escribe la nota $i: ");
    $notas[] = $nota;
}

$suma = array_sum($notas);
$media = $suma / count($notas);

echo "La media aritmética de las notas es: $media\n";
if ($media < 5) {
    echo "Boletín: Suspendido\n";
} else if ($media >= 5 && $media <= 6) {
    echo "Boletín: Aprobado\n";
} else if ($media >= 6 && $media <= 7) {
    echo "Boletín: Bien\n";
} else if ($media >= 7 && $media <= 8) {
    echo "Boletín: Notable\n";
} else if ($media >= 8 && $media <= 9) {
    echo "Boletín: Notable\n";
} else if ($media >= 9 && $media <= 10) {
    echo "Boletín: Sobresaliente\n";
}

?>