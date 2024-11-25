<?php

/**
 * @Author: Álvaro Escartí
 */

// Lista de zonas horarias más populares (generadas por CHATGPT)
$zonas_populares = [
    "Europe/Madrid",
    "Europe/London",
    "America/New_York",
    "America/Los_Angeles",
    "Asia/Tokyo",
    "Asia/Shanghai",
    "Asia/Dubai",
    "Asia/Kolkata",
    "America/Mexico_City",
    "America/Buenos_Aires",
    "Europe/Paris",
    "Europe/Berlin",
    "Australia/Sydney",
    "Africa/Johannesburg",
    "Europe/Moscow",
    "America/Sao_Paulo",
    "Asia/Singapore",
    "Asia/Hong_Kong",
    "America/Chicago",
    "Pacific/Auckland"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener zona seleccionada
    $zona_seleccionada = $_POST['zona'];
    date_default_timezone_set($zona_seleccionada);
    $fechaActual = new DateTime('now', new DateTimeZone($zona_seleccionada));

    // Mostrar hora actual
    echo "<h2>Hora actual en " . str_replace(['_', '/'], [' ', ' - '], $zona_seleccionada) . ":</h2>";
    echo "<p>Hora: " . $fechaActual->format("H:i:s") . "</p>";
    echo "<p>Fecha: " . $fechaActual->format("d/m/Y") . "</p>";

}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Selector de Zona Horaria</title>
</head>

<body>
    <h1>Hora en Diferentes Zonas Horarias</h1>

    <form method="post">
        <label for="zona">Seleccione una zona horaria:</label>
        <select name="zona" id="zona" required>
            <?php
            // Generar opciones del selector
            foreach ($zonas_populares as $zona) {
                // Formatear el nombre de la zona para que sea más legible
                $ciudad = str_replace(['_', '/'], [' ', ' - '], $zona);
                echo "<option value='$zona'" .
                    (isset($_POST['zona']) && $_POST['zona'] == $zona ? ' selected' : '') .
                    ">$ciudad</option>";
            }
            ?>
        </select>
        <input type="submit" value="Mostrar Hora">
    </form>
</body>

</html>