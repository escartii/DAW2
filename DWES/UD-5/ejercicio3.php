<?php

/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger la opción seleccionada y la cantidad del formulario
    $opcion = $_POST["opcion"];
    $cantidad = $_POST["cantidad"];

    // Validar la entrada del usuario
    if (!is_numeric($cantidad)) {
        echo "Entrada no válida. Por favor, introduce un número válido.<br>";
    } else {
        // Realizar la conversión según la opción seleccionada
        if ($opcion == 1) {
            $euros = $cantidad;
            $pesetas = $euros * 166.386;
            echo "$euros euros son $pesetas pesetas.<br>";
        } elseif ($opcion == 2) {
            $pesetas = $cantidad;
            $euros = $pesetas / 166.386;
            echo "El resultado de convertir $pesetas pesetas a euros es: $euros<br>";
        } else {
            echo "Opción no válida. Por favor, selecciona 1 o 2.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor Euros - Pesetas</title>
</head>
<body>
    <h1>Conversión entre Euros y Pesetas</h1>
    <form method="POST" action="">
        <label for="opcion">Elige la dirección de conversión:</label><br>
        <input type="radio" id="euros_a_pesetas" name="opcion" value="1" required>
        <label for="euros_a_pesetas">Euros a Pesetas</label><br>

        <input type="radio" id="pesetas_a_euros" name="opcion" value="2" required>
        <label for="pesetas_a_euros">Pesetas a Euros</label><br><br>

        <label for="cantidad">Introduce la cantidad a convertir:</label><br>
        <input type="text" id="cantidad" name="cantidad" required><br><br>

        <input type="submit" value="Convertir">
    </form>
</body>
</html>
