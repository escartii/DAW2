<?php

/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hora = $_POST['hora'];
    
    if (validarHora($hora)) {
        echo 'La hora está correctamente expresada.';
    } else {
        echo 'La hora no está correctamente expresada.';
    }
}

function validarHora($hora) {
    // Verificar que la hora tenga el formato correcto (horas:minutos:segundos)
    if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $hora)) {
        // Separar la hora en horas, minutos y segundos
        list($horas, $minutos, $segundos) = explode(':', $hora);
        
        // Verificar que las horas, minutos y segundos sean números válidos
        if (is_numeric($horas) && is_numeric($minutos) && is_numeric($segundos)) {
            // Verificar que las horas estén en el rango correcto (0-23)
            if ($horas >= 0 && $horas <= 23) {
                // Verificar que los minutos estén en el rango correcto (0-59)
                if ($minutos >= 0 && $minutos <= 59) {
                    // Verificar que los segundos estén en el rango correcto (0-59)
                    if ($segundos >= 0 && $segundos <= 59) {
                        return true; // La hora está correctamente expresada
                    }
                }
            }
        }
    }
    
    return false; // La hora no está correctamente expresada
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - UD5</title>
</head>
<body>
    <form method="POST" action="">
        <label for="hora">Introduce una hora a comprobar</label><br>
        <input type="text" name="hora" id="hora" required><br><br>
        <input type="submit" value="Comprobar">
    </form>
</body>
</html>