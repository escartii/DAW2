<?php

/**
 * @Author: Álvaro Escartí
 */

// Función para calcular el precio de una llamada
function calcularPrecio($tiempoLlamada) {
    $precio = 0.10; // Precio por los primeros 3 minutos
    if ($tiempoLlamada < 3) {
        return $precio; // Si la llamada es menos de 3 minutos, se cobra 10 céntimos
    } else {
        $minutosAdicionales = $tiempoLlamada - 3;
        $costeAdicional = $minutosAdicionales * 0.05; // Cada minuto adicional cuesta 5 céntimos
        return $precio + $costeAdicional; // Total de la llamada
    }
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar un array para guardar los tiempos de las 5 llamadas
    $total = 0;
    for ($i = 1; $i <= 5; $i++) {
        // Verificar que el campo de la llamada existe en $_POST antes de acceder a él
        if (isset($_POST["tiempoLlamada$i"])) {
            $tiempoLlamada = (float)$_POST["tiempoLlamada$i"];
            // Calcular el precio de la llamada y sumarlo al total
            $total += calcularPrecio($tiempoLlamada);
        }
    }

   echo "El precio total de las llamadas es: $total euros";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Llamadas</title>
</head>

<body>
    <h1>Calculadora de Llamadas Telefónicas</h1>
    <form method="POST" action="">
        <label for="tiempoLlamada1">Duración de la llamada 1 (en minutos):</label>
        <input type="number" id="tiempoLlamada1" name="tiempoLlamada1" min="0" step="0.1" required><br><br>

        <label for="tiempoLlamada2">Duración de la llamada 2 (en minutos):</label>
        <input type="number" id="tiempoLlamada2" name="tiempoLlamada2" min="0" step="0.1" required><br><br>

        <label for="tiempoLlamada3">Duración de la llamada 3 (en minutos):</label>
        <input type="number" id="tiempoLlamada3" name="tiempoLlamada3" min="0" step="0.1" required><br><br>

        <label for="tiempoLlamada4">Duración de la llamada 4 (en minutos):</label>
        <input type="number" id="tiempoLlamada4" name="tiempoLlamada4" min="0" step="0.1" required><br><br>

        <label for="tiempoLlamada5">Duración de la llamada 5 (en minutos):</label>
        <input type="number" id="tiempoLlamada5" name="tiempoLlamada5" min="0" step="0.1" required><br><br>

        <input type="submit" value="Calcular Total">
    </form>
</body>

</html>
