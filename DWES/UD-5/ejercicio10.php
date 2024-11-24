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

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"]; // Obtener la acción seleccionada (máximo, mínimo, medio)

    // Mostrar el resultado dependiendo de la acción seleccionada
    if ($accion == "maximo") {
        echo "el salario máximo es: €" . salarioMaximo($trabajadores) . "</h2>";
    } elseif ($accion == "minimo") {
        echo "el salario mínimo es: €" . salarioMinimo($trabajadores) . "</h2>";
    } elseif ($accion == "medio") {
       echo "el salario medio es: €" . salarioMedio($trabajadores) . "</h2>";
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
            <option value="maximo">Salario Máximo</option>
            <option value="minimo">Salario Mínimo</option>
            <option value="medio">Salario Medio</option>
        </select>
        <br><br>
        <input type="submit" value="Calcular">
    </form>
</body>

</html>
