<?php

/**
 * @Author: Álvaro Escartí
 */

$mensajes = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = isset($_POST["numero1"]) ? trim($_POST["numero1"]) : '';
    $numero2 = isset($_POST["numero2"]) ? trim($_POST["numero2"]) : '';
    $operaciones = isset($_POST["operacion"]) ? $_POST["operacion"] : [];

    if ($numero1 === '') {
        $mensajes[] = "El primer número es obligatorio.";
    }

    if ($numero2 === '') {
        $mensajes[] = "El segundo número es obligatorio.";
    }

    if (empty($operaciones)) {
        $mensajes[] = "Debe seleccionar al menos una operación.";
    }

    // Si no hay errores en los campos vacíos, continuar con la validación
    if (empty($mensajes)) {
        // Verificar que los valores sean números enteros positivos
        if (ctype_digit($numero1) && ctype_digit($numero2)) {
            $numero1 = (int)$numero1;
            $numero2 = (int)$numero2;

            foreach ($operaciones as $operacion) {
                switch ($operacion) {
                    case "suma":
                        $resultado = $numero1 + $numero2;
                        $mensajes[] = "La suma de: " . $numero1 . " + " . $numero2 . " es: " . $resultado . ".";
                        break;
                    case "resta":
                        $resultado = $numero1 - $numero2;
                        $mensajes[] = "La resta de: " . $numero1 . " - " . $numero2 . " es: " . $resultado . ".";
                        break;
                    case "multiplicación":
                        $resultado = $numero1 * $numero2;
                        $mensajes[] = "La multiplicación de: " . $numero1 . " * " . $numero2 . " es: " . $resultado . ".";
                        break;
                    case "división":
                        if ($numero2 != 0) {
                            $resultado = $numero1 / $numero2;
                            $mensajes[] = "La división de: " . $numero1 . " / " . $numero2 . " es: " . $resultado . ".";
                        } else {
                            $mensajes[] = "No se puede dividir entre cero.";
                        }
                        break;
                    default:
                        $mensajes[] = "Operación no válida seleccionada.";
                        break;
                }
            }
        } else {
            $mensajes[] = "No se puede realizar la operación. Asegúrate de introducir números válidos (enteros positivos).";
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
    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="ejercicio1.php">
        <label for="numero1">Introduce el primer número:</label>
        <input type="text" name="numero1" id="numero1" value="<?php echo isset($_POST['numero1']) ? htmlspecialchars($_POST['numero1']) : ''; ?>"><br>

        <label for="numero2">Introduce el segundo número:</label>
        <input type="text" name="numero2" id="numero2" value="<?php echo isset($_POST['numero2']) ? htmlspecialchars($_POST['numero2']) : ''; ?>"><br>

        <label for="operacion">Selecciona las operaciones a realizar:</label>
        <select name="operacion[]" id="operacion" multiple>
            <option value="suma" <?php echo (isset($_POST['operacion']) && in_array('suma', $_POST['operacion'])) ? 'selected' : ''; ?>>Suma</option>
            <option value="resta" <?php echo (isset($_POST['operacion']) && in_array('resta', $_POST['operacion'])) ? 'selected' : ''; ?>>Resta</option>
            <option value="multiplicación" <?php echo (isset($_POST['operacion']) && in_array('multiplicación', $_POST['operacion'])) ? 'selected' : ''; ?>>Multiplicación</option>
            <option value="división" <?php echo (isset($_POST['operacion']) && in_array('división', $_POST['operacion'])) ? 'selected' : ''; ?>>División</option>
        </select><br>

        <input type="submit" value="Calcular">
    </form>
</body>

</html>
