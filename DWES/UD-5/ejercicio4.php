<?php

/**
 * @Author: Álvaro Escartí
 */

$mensajes = []; // Array para almacenar mensajes de error o resultados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar la variable 'salario' con el valor enviado o vacío
    $horasTrabajadas = isset($_POST["salario"]) ? trim($_POST["salario"]) : '';

    // Validar que el campo no esté vacío
    if ($horasTrabajadas === '') {
        $mensajes[] = "El campo de horas trabajadas es obligatorio.";
    } else {
        // Verificar que el valor sea un número válido
        if (is_numeric($horasTrabajadas)) {
            $horasTrabajadas = floatval($horasTrabajadas); // Convertir a número (puede ser decimal)

            if ($horasTrabajadas < 0) {
                $mensajes[] = "El número de horas trabajadas no puede ser negativo.";
            } else {
                // Calcular el salario según las horas trabajadas
                if ($horasTrabajadas <= 40) {
                    $salario = $horasTrabajadas * 12;
                } else {
                    $salario = 40 * 12 + ($horasTrabajadas - 40) * 16;
                }

                // Formatear el salario a dos decimales
                $salario = number_format($salario, 2);

                $mensajes[] = "El salario semanal del trabajador es: $salario euros.";
            }
        } else {
            $mensajes[] = "Entrada no válida. Por favor, introduce un número válido para las horas trabajadas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Salario</title>
</head>
<body>
    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h1>Calculadora de Salario Semanal</h1>
    <form method="POST" action="">
        <label for="salario">Introduce las horas trabajadas:</label><br>
        <input type="text" name="salario" id="salario" value="<?php echo isset($_POST['salario']) ? htmlspecialchars($_POST['salario']) : ''; ?>"><br><br>
        <input type="submit" value="Calcular Salario">
    </form>
</body>
</html>
