<?php

/**
 * @Author: Álvaro Escartí
 */

// Función para calcular la tabla de multiplicar de un número
function generarTablaMultiplicar($num) {
    $tabla = [];
    for ($i = 1; $i <= 10; $i++) {
        $resultado = $num * $i;
        $tabla[] = "$num x $i = $resultado";
    }
    return $tabla;
}

$mensajes = []; // Array para almacenar mensajes de error o resultados
$tablaMultiplicar = []; // Array para almacenar la tabla de multiplicar seleccionada
$numeroSeleccionado = null; // Variable para almacenar el número seleccionado

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y sanitizar la entrada del usuario
    $numero = isset($_POST["num"]) ? trim($_POST["num"]) : '';

    // Validar que el campo 'num' no esté vacío
    if ($numero === '') {
        $mensajes[] = "Debe seleccionar un número para generar su tabla de multiplicar.";
    } else {
        // Verificar que 'num' sea un número válido entre 1 y 10
        if (!ctype_digit($numero)) {
            $mensajes[] = "El valor seleccionado no es un número válido.";
        } else {
            $numero = (int)$numero;
            if ($numero < 1 || $numero > 10) {
                $mensajes[] = "El número seleccionado debe estar entre 1 y 10.";
            } else {
                // Si todas las validaciones pasan, generar la tabla de multiplicar
                $tablaMultiplicar = generarTablaMultiplicar($numero);
                $numeroSeleccionado = $numero;
                $mensajes[] = "Tabla de multiplicar del número $numero:";
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
    <title>Calculadora de Tablas de Multiplicar</title>
</head>
<body>
    <h1>Calculadora de Tablas de Multiplicar</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($tablaMultiplicar)): ?>
        <ul>
            <?php foreach ($tablaMultiplicar as $fila): ?>
                <li><?php echo htmlspecialchars($fila); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="num">Seleccionar número:</label>
        <select name="num" id="num">
            <option value="">--Selecciona un número--</option>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo (isset($_POST['num']) && $_POST['num'] == $i) ? 'selected' : ''; ?>>
                    <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        </select>
        <br><br>
        <input type="submit" value="Calcular Total">
    </form>
</body>
</html>
