<?php
/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las fechas introducidas por el usuario
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFinal = $_POST['fecha_final'];

    // Convertir las fechas a objetos DateTime
    $inicio = new DateTime($fechaInicio);
    $final = new DateTime($fechaFinal);

    // Calcular la diferencia entre las fechas
    $diferencia = $inicio->diff($final);

    // Obtener los días, horas y minutos
    $dias = $diferencia->days;
    $horas = $diferencia->h;
    $minutos = $diferencia->i;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcula Diferencia de Fechas</title>
</head>
<body>
    <h1>Calcula la Diferencia entre Dos Fechas</h1>
    <form method="POST" action="">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" required>
        <br><br>

        <label for="fecha_final">Fecha final:</label>
        <input type="datetime-local" id="fecha_final" name="fecha_final" required>
        <br><br>

        <button type="submit">Calcular</button>
    </form>

    <?php if (isset($dias) && isset($horas) && isset($minutos)): ?>
        <h2>Resultados:</h2>
        <p>Días: <?= $dias ?></p>
        <p>Horas: <?= $horas ?></p>
        <p>Minutos: <?= $minutos ?></p>
    <?php endif; ?>
</body>
</html>
