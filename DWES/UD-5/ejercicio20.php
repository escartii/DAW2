<?php

/**
 * @Author: Álvaro Escartí
 */


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hora = intval($_POST['hora']);

    if ($hora >= 6 && $hora < 12) {
        $saludo = "Buenos días";
    } elseif ($hora >= 13 && $hora < 21) {
        $saludo = "Buenas tardes";
    } else {
        $saludo = "Buenas noches";
    }

    echo "<h2>$saludo</h2>";
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Saludo según Hora</title>
</head>
<body>
    <h1>Saludo según la Hora</h1>
    
    <form method="post">
        <label for="hora">Introduzca la hora (0-23):</label>
        <input type="number" id="hora" name="hora" min="0" max="23" required>
        <input type="submit" value="Mostrar Saludo">
    </form>
</body>
</html>