<?php

/**
 * @Author: Álvaro Escartí
 */

// Definir el array asociativo de trabajadores con sus salarios
$trabajadores = [
    "Alvaro" => 3000,
    "Marc" => 3000,
    "Javi" => 999,
    "Jorge" => 1800,
    "Antonio" => 5300
];

// Función para calcular el salario actual de un trabajador
function salarioActual($trabajadores) {
    return $trabajadores;
}

// Función para calcular el salario aumentado según el porcentaje
function salarioAumentado($trabajadores, $porcentaje) {
    $salariosAumentados = [];
    foreach ($trabajadores as $nombre => $salario) {
        $salariosAumentados[$nombre] = $salario + ($salario * ($porcentaje / 100));
    }
    return $salariosAumentados;
}

$mensajes = []; // Array para almacenar mensajes de error o resultados
$salariosMostrados = []; // Array para almacenar los salarios a mostrar

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las entradas del usuario
    $accion = isset($_POST["accion"]) ? trim($_POST["accion"]) : '';
    $porcentaje = isset($_POST["porcentaje"]) ? trim($_POST["porcentaje"]) : '';

    // Validar que la acción esté seleccionada
    if ($accion === '') {
        $mensajes[] = "Debe seleccionar una acción para calcular.";
    } else {
        // Definir las acciones válidas
        $accionesValidas = ["actual", "aumentado"];
        if (!in_array($accion, $accionesValidas)) {
            $mensajes[] = "La acción seleccionada no es válida.";
        } else {
            // Si la acción es 'aumentado', validar el porcentaje
            if ($accion === "aumentado") {
                if ($porcentaje === '') {
                    $mensajes[] = "El campo 'Porcentaje de aumento' es obligatorio para calcular salarios aumentados.";
                } elseif (!is_numeric($porcentaje)) {
                    $mensajes[] = "El porcentaje de aumento debe ser un número válido.";
                } elseif ($porcentaje < 0) {
                    $mensajes[] = "El porcentaje de aumento no puede ser negativo.";
                }
            }

            // Si no hay errores, proceder con el cálculo
            if (empty($mensajes)) {
                if ($accion === "actual") {
                    $salariosMostrados = salarioActual($trabajadores);
                    $mensajes[] = "Salarios actuales de los trabajadores:";
                } elseif ($accion === "aumentado") {
                    $porcentaje = (float)$porcentaje;
                    $salariosMostrados = salarioAumentado($trabajadores, $porcentaje);
                    $mensajes[] = "Salarios aumentados en $porcentaje%:";
                }
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
    <title>Salarios de Trabajadores</title>
</head>
<body>
    <h1>Calculadora de Salarios de Trabajadores</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($salariosMostrados)): ?>
        <ul>
            <?php foreach ($salariosMostrados as $nombre => $salario): ?>
                <li><?php echo htmlspecialchars($nombre) . ": €" . number_format($salario, 2); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="accion">Selecciona qué cálculo deseas realizar:</label>
        <select name="accion" id="accion">
            <option value="">--Selecciona una acción--</option>
            <option value="actual" <?php echo (isset($_POST['accion']) && $_POST['accion'] === 'actual') ? 'selected' : ''; ?>>Salario Actual</option>
            <option value="aumentado" <?php echo (isset($_POST['accion']) && $_POST['accion'] === 'aumentado') ? 'selected' : ''; ?>>Salario Aumentado</option>
        </select>
        <br><br>

        <label for="porcentaje">Porcentaje de aumento:</label>
        <input type="number" id="porcentaje" name="porcentaje" step="0.1" value="<?php echo isset($_POST['porcentaje']) ? htmlspecialchars($_POST['porcentaje']) : ''; ?>">
        <br><br>

        <input type="submit" value="Calcular">
    </form>
</body>
</html>
