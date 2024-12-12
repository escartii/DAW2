<?php

/**
 * @Author: Álvaro Escartí
 */

// Función para validar la hora en formato HH:MM:SS
function validarHora($hora) {
    // Verificar que la hora tenga el formato correcto (horas:minutos:segundos)
    if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $hora)) {
        // Separar la hora en horas, minutos y segundos
        list($horas, $minutos, $segundos) = explode(':', $hora);
        
        // Verificar que las horas, minutos y segundos sean números válidos
        if (is_numeric($horas) && is_numeric($minutos) && is_numeric($segundos)) {
            $horas = (int)$horas;
            $minutos = (int)$minutos;
            $segundos = (int)$segundos;
            
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

$mensajes = []; // Array para almacenar mensajes de error o resultados

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicializar la variable 'hora' con el valor enviado o vacío
    $hora = isset($_POST['hora']) ? trim($_POST['hora']) : '';

    // Validar que el campo no esté vacío
    if ($hora === '') {
        $mensajes[] = "El campo de hora es obligatorio.";
    } else {
        // Validar que el usuario haya ingresado exactamente 8 caracteres (HH:MM:SS)
        if (mb_strlen($hora, 'UTF-8') != 8) {
            $mensajes[] = "Por favor, introduce la hora en el formato correcto (HH:MM:SS).";
        } else {
            // Validar el formato y los valores de la hora
            if (validarHora($hora)) {
                $mensajes[] = "La hora está correctamente expresada.";
            } else {
                $mensajes[] = "La hora no está correctamente expresada. Asegúrate de que las horas estén entre 00 y 23, y que los minutos y segundos estén entre 00 y 59.";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí</title>
</head>
<body>
    <h1>Comprobación de Hora</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="hora">Introduce una hora a comprobar (HH:MM:SS):</label><br>
        <input type="text" name="hora" id="hora" maxlength="8" value="<?php echo isset($_POST['hora']) ? htmlspecialchars($_POST['hora']) : ''; ?>"><br><br>
        <input type="submit" value="Comprobar">
    </form>
</body>
</html>
