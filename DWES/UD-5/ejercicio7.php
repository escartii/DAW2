
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

$mensajes = []; // Array para almacenar mensajes de error o resultados
$total = 0; // Variable para almacenar el total de las llamadas

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar un array para guardar los tiempos de las 5 llamadas
    $tiemposLlamadas = [];

    // Validar cada una de las 5 llamadas
    for ($i = 1; $i <= 5; $i++) {
        $campo = "tiempoLlamada$i";
        if (isset($_POST[$campo])) {
            $tiempoLlamada = trim($_POST[$campo]);

            // Verificar que el campo no esté vacío
            if ($tiempoLlamada === '') {
                $mensajes[] = "El campo para la llamada $i está vacío. Por favor, introduce la duración.";
            } elseif (!is_numeric($tiempoLlamada)) {
                $mensajes[] = "El valor para la llamada $i no es un número válido.";
            } elseif ($tiempoLlamada < 0) {
                $mensajes[] = "El tiempo para la llamada $i no puede ser negativo.";
            } else {
                // Guardar el tiempo válido
                $tiemposLlamadas[$i] = (float)$tiempoLlamada;
            }
        } else {
            $mensajes[] = "El campo para la llamada $i no está definido.";
        }
    }

    // Si no hay errores, calcular el total
    if (empty($mensajes)) {
        foreach ($tiemposLlamadas as $tiempo) {
            $total += calcularPrecio($tiempo);
        }
        // Formatear el total a dos decimales
        $total = number_format($total, 2);
        $mensajes[] = "El precio total de las llamadas es: $total euros.";
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
    <h1>Calculadora de Llamadas Telefónicas</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <label for="tiempoLlamada<?php echo $i; ?>">Duración de la llamada <?php echo $i; ?> (en minutos):</label>
            <input type="number" id="tiempoLlamada<?php echo $i; ?>" name="tiempoLlamada<?php echo $i; ?>" min="0" step="0.1"
                value="<?php echo isset($_POST["tiempoLlamada$i"]) ? htmlspecialchars($_POST["tiempoLlamada$i"]) : ''; ?>">
            <br><br>
        <?php endfor; ?>

        <input type="submit" value="Calcular Total">
    </form>
</body>
</html>
