<?php

/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (is_numeric($_POST['numero'])) {
        if($_POST['numero'] <= 15) {
            echo "primera quincena";
        } else {
            echo "segunda quincena";
        }
    } else {
        echo "el input no es un número.";
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
    <form method="POST" action="">
    <label for="numero1">Introduce el primer número:</label>
    <input type="text" name="numero" id="numero" required><br>
    </form>
</body>
</html>