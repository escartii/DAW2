<?php

/**
* @Author: Álvaro Escartí
*/

// Definir el array asociativo de trabajadores con sus salarios
$trabajadores = [
    "Alvaro" => 3000,
    "Marc" => 3000,
    "Javi" => 999,
    "Jorge" => 1800,
    "Antonio" => 5300
];

// Función para calcular el salario actual de un trabajador
function salarioActual($trabajadores) {
    return $trabajadores;
}

// Función para calcular el salario aumentado según el porcentaje
function salarioAumentado($trabajadores, $porcentaje) {
    $salariosAumentados = [];
    foreach ($trabajadores as $nombre => $salario) {
        $salariosAumentados[$nombre] = $salario + ($salario * ($porcentaje / 100));
    }
    return $salariosAumentados;
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $porcentaje = (float)$_POST["porcentaje"]; // Obtener el porcentaje del formulario
    $accion = $_POST["accion"]; // Obtener la acción seleccionada (actual o aumentado)

    // Mostrar el salario actual o aumentado dependiendo de la acción seleccionada
    if ($accion == "actual") {
        echo "<h2>Salario actual de los trabajadores:</h2>";
        foreach ($trabajadores as $nombre => $salario) {
            echo "<p>$nombre: €" . number_format($salario, 2) . "</p>";
        }
    } elseif ($accion == "aumentado") {
        $salariosAumentados = salarioAumentado($trabajadores, $porcentaje);
        echo "<h2>Salarios aumentados en $porcentaje%:</h2>";
        foreach ($salariosAumentados as $nombre => $salario) {
            echo "<p>$nombre: €" . number_format($salario, 2) . "</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salarios de Trabajadores</title>
</head>

<body>
    <h1>Calculadora de Salarios de Trabajadores</h1>

    <form method="POST" action="">
        <label for="accion">Selecciona qué cálculo deseas realizar:</label>
        <select name="accion" id="accion" required>
            <option value="actual">Salario Actual</option>
            <option value="aumentado">Salario Aumentado</option>
        </select>
        <br><br>

        <label for="porcentaje">Porcentaje de aumento:</label>
        <input type="number" id="porcentaje" name="porcentaje" required>
        <br><br>

        <input type="submit" value="Calcular">
    </form>
</body>

</html>
