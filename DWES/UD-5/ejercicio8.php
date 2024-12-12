<?php
/**
 * @Author: Álvaro Escartí
 */

$mensajes = []; // Array para almacenar mensajes de error o resultados
$dias = $horas = $minutos = null; // Inicializar variables para los resultados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener las fechas introducidas por el usuario
    $fechaInicio = isset($_POST['fecha_inicio']) ? trim($_POST['fecha_inicio']) : '';
    $fechaFinal = isset($_POST['fecha_final']) ? trim($_POST['fecha_final']) : '';

    // Validar que ambos campos no estén vacíos
    if ($fechaInicio === '') {
        $mensajes[] = "La fecha de inicio es obligatoria.";
    }

    if ($fechaFinal === '') {
        $mensajes[] = "La fecha final es obligatoria.";
    }

    // Si no hay errores de campos vacíos, continuar con la validación
    if (empty($mensajes)) {
        // Intentar crear objetos DateTime, capturando posibles excepciones
        try {
            $inicio = new DateTime($fechaInicio);
        } catch (Exception $e) {
            $mensajes[] = "La fecha de inicio no es válida.";
        }

        try {
            $final = new DateTime($fechaFinal);
        } catch (Exception $e) {
            $mensajes[] = "La fecha final no es válida.";
        }

        // Si ambos objetos DateTime se crearon correctamente, proceder
        if (isset($inicio) && isset($final)) {
            // Verificar que la fecha de inicio no sea posterior a la fecha final
            if ($inicio > $final) {
                $mensajes[] = "La fecha de inicio no puede ser posterior a la fecha final.";
            } else {
                // Calcular la diferencia entre las fechas
                $diferencia = $inicio->diff($final);

                // Obtener los días, horas y minutos
                $dias = $diferencia->days;
                $horas = $diferencia->h;
                $minutos = $diferencia->i;

                // Añadir el mensaje de resultado
                $mensajes[] = "La diferencia entre las fechas es de $dias días, $horas horas y $minutos minutos.";
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
    <title>Calcula Diferencia de Fechas</title>
</head>
<body>
    <h1>Calcula la Diferencia entre Dos Fechas</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" 
            value="<?php echo isset($_POST['fecha_inicio']) ? htmlspecialchars($_POST['fecha_inicio']) : ''; ?>">
        <br><br>

        <label for="fecha_final">Fecha final:</label>
        <input type="datetime-local" id="fecha_final" name="fecha_final" 
            value="<?php echo isset($_POST['fecha_final']) ? htmlspecialchars($_POST['fecha_final']) : ''; ?>">
        <br><br>

        <button type="submit">Calcular</button>
    </form>
</body>
</html>
