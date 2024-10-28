<?php

/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $horasTrabajadas = $_POST["salario"];

    if (!is_numeric($horasTrabajadas)) {
        echo "Entrada no válida. Por favor, introduce un número válido.<br>";
    } else {
        $salario = 0;
        if ($horasTrabajadas <= 40) {
            $salario = $horasTrabajadas * 12;
        } else {
            $salario = 40 * 12 + ($horasTrabajadas - 40) * 16;
        }
        echo "El salario semanal del trabajador es: $salario euros<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Salario</title>
</head>
<body>
    <h1>Calculadora de Salario Semanal</h1>
    <form method="POST" action="">
        <label for="salario">Introduce las horas trabajadas:</label><br>
        <input type="text" name="salario" id="salario" required><br><br>
        <input type="submit" value="Calcular Salario">
    </form>
</body>
</html>
