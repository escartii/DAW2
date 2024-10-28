<?php

/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifico que los valores sean números
    if (ctype_digit($_POST["numero1"]) && ctype_digit($_POST["numero2"])) {
        $numero1 = (int)$_POST["numero1"];
        $numero2 = (int)$_POST["numero2"];
        $operaciones = $_POST["operacion"];
        
        foreach ($operaciones as $operacion) {
            switch ($operacion) {
                case "suma":
                    $resultado = $numero1 + $numero2;
                    echo ("La suma de: " . $numero1 . " + " . $numero2 . " es: " . $resultado . "<br>");
                    break;
                case "resta":
                    $resultado = $numero1 - $numero2;
                    echo ("La resta de: " . $numero1 . " - " . $numero2 . " es: " . $resultado . "<br>");
                    break;
                case "multiplicación":
                    $resultado = $numero1 * $numero2;
                    echo ("La multiplicación de: " . $numero1 . " * " . $numero2 . " es: " . $resultado . "<br>");
                    break;
                case "división":
                    if ($numero2 != 0) {
                        $resultado = $numero1 / $numero2;
                        echo ("La división de: " . $numero1 . " / " . $numero2 . " es: " . $resultado . "<br>");
                    } else {
                        echo ("No se puede dividir entre cero.<br>");
                    }
                    break;
            }
        }
    } else {
        echo ("No se puede realizar la operación. Asegúrate de introducir números válidos.<br>");
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
    <form method="POST" action="ejercicio1.php">
        <label for="numero1">Introduce el primer número:</label>
        <input type="text" name="numero1" id="numero1" required><br>

        <label for="numero2">Introduce el segundo número:</label>
        <input type="text" name="numero2" id="numero2" required><br>

        <label for="operacion">Selecciona las operaciones a realizar:</label>
        <select name="operacion[]" id="operacion" multiple required>
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicación">Multiplicación</option>
            <option value="división">División</option>
        </select><br>

        <input type="submit" value="Calcular">
    </form>
</body>

</html>
