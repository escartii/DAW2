<?php

/**
 * @Author: Álvaro Escartí
 */


function calcularMedia($numeros){
    return array_sum($numeros) / count($numeros);
}

function calcularModa($numeros){
    $frecuencias = array_count_values($numeros);
    $max_frecuencia = max($frecuencias);
    $modas = array_keys($frecuencias, $max_frecuencia);
    return $modas;
}

function calcularMediana($numeros){
    sort($numeros);
    $total = count($numeros);
    $mitad = floor($total / 2);

    if ($total % 2 == 0) {
        // Si es par, promedio de los dos números centrales
        return ($numeros[$mitad - 1] + $numeros[$mitad]) / 2;
    } else {
        // Si es impar, el número del medio
        return $numeros[$mitad];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Convertir la cadena de números a un array
    $numeros_str = $_POST['numeros'];
    $numeros = array_map('trim', explode(',', $numeros_str));
    $numeros = array_map('floatval', $numeros);

    echo "<h2>Resultados:</h2>";

    // Verificar qué medidas calcular
    if (isset($_POST['medidas'])) {
        foreach ($_POST['medidas'] as $medida) {
            switch ($medida) {
                case 'media':
                    $resultado_media = calcularMedia($numeros);
                    echo "<p><strong>Media:</strong> " . number_format($resultado_media, 2) . "</p>";
                    break;

                case 'moda':
                    $resultado_moda = calcularModa($numeros);
                    echo "<p><strong>Moda:</strong> " . implode(', ', $resultado_moda) . "</p>";
                    break;

                case 'mediana':
                    $resultado_mediana = calcularMediana($numeros);
                    echo "<p><strong>Mediana:</strong> " . number_format($resultado_mediana, 2) . "</p>";
                    break;
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora de Medidas Estadísticas</title>
</head>

<body>
    <h1>Calculadora de Medidas Estadísticas</h1>

    <form method="post">
        <label for="numeros">Introduzca los números separados por comas:</label><br>
        <input type="text" id="numeros" name="numeros" required><br><br>

        <label>Seleccione las medidas a calcular:</label><br>
        <input type="checkbox" id="media" name="medidas[]" value="media">
        <label for="media">Media</label><br>

        <input type="checkbox" id="moda" name="medidas[]" value="moda">
        <label for="moda">Moda</label><br>

        <input type="checkbox" id="mediana" name="medidas[]" value="mediana">
        <label for="mediana">Mediana</label><br><br>

        <input type="submit" value="Calcular">
    </form>
</body>

</html>