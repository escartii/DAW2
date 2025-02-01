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

// Recuperar los valores anteriores antes de sobrescribir
$zona_anterior = isset($_COOKIE['zona_horaria']) ? json_decode($_COOKIE['zona_horaria'], true)['zona'] : 'Ninguna';
$hora_anterior = isset($_COOKIE['zona_horaria']) ? json_decode($_COOKIE['zona_horaria'], true)['hora'] : 'Ninguna';
$fecha_anterior = isset($_COOKIE['zona_horaria']) ? json_decode($_COOKIE['zona_horaria'], true)['fecha'] : 'Ninguna';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener zona seleccionada
    $zona_seleccionada = $_POST['zona'];
    date_default_timezone_set($zona_seleccionada);
    $fechaActual = new DateTime('now', new DateTimeZone($zona_seleccionada));

    // Crear un array con los datos actuales
    $datos_zona = array(
        'zona' => $zona_seleccionada,
        'hora' => $fechaActual->format("H:i:s"),
        'fecha' => $fechaActual->format("d/m/Y")
    );

    // Convertir el array a JSON
    $datos_json = json_encode($datos_zona);

    // Guardar los datos en una cookie
    setcookie("zona_horaria", $datos_json, time() + 3600); // Cookie válida por 1 hora

    // Redirigir para evitar el reenvío del formulario al recargar
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} else {
    // Si no se ha enviado el formulario, usar los valores anteriores
    $zona_actual = $zona_anterior;
    $hora_actual = $hora_anterior;
    $fecha_actual = $fecha_anterior;
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

    <?php if ($zona_actual !== 'Ninguna'): ?>
        <h2>Hora actual en <?php echo str_replace(['_', '/'], [' ', ' - '], $zona_actual); ?>:</h2>
        <p>Hora: <?php echo $hora_actual; ?></p>
        <p>Fecha: <?php echo $fecha_actual; ?></p>
    <?php endif; ?>

    <?php if ($zona_anterior !== 'Ninguna'): ?>
        <h2>Datos anteriores (cookies):</h2>
        <p>Zona anterior: <?php echo str_replace(['_', '/'], [' ', ' - '], $zona_anterior); ?></p>
        <p>Hora anterior: <?php echo $hora_anterior; ?></p>
        <p>Fecha anterior: <?php echo $fecha_anterior; ?></p>
    <?php endif; ?>
</body>

</html>