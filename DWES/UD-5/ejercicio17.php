<?php

/**
 * @Author: Álvaro Escartí
 */

// Array asociativo con palabras en inglés y sus traducciones en español
$palabras = [
    'dog' => 'perro',
    'cat' => 'gato',
    'house' => 'casa',
    'car' => 'coche',
    'book' => 'libro',
    'computer' => 'ordenador',
    'phone' => 'teléfono',
    'table' => 'mesa',
    'water' => 'agua',
    'school' => 'escuela'
];

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mostrar traducciones seleccionadas
    echo "<h2>Traducciones Seleccionadas:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Inglés</th><th>Español</th></tr>";
    
    // Comprobar si se han seleccionado palabras
    if (isset($_POST['palabras'])) {
        // Recorrer las palabras seleccionadas
        foreach ($_POST['palabras'] as $palabra) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($palabra) . "</td>";
            echo "<td>" . htmlspecialchars($palabras[$palabra]) . "</td>";
            echo "</tr>";
        }
    }
    
    echo "</table>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Traductor de Palabras</title>
</head>
<body>
    <h1>Traductor de Palabras Inglés-Español</h1>
    
    <form method="post">
        <table border="1">
            <tr>
                <th>Seleccionar</th>
                <th>Inglés</th>
                <th>Español</th>
            </tr>
            <?php
            // Generar filas de la tabla con casillas de verificación
            foreach ($palabras as $english => $spanish) {
                echo "<tr>";
                // Crear casilla de verificación para cada palabra
                echo "<td><input type='checkbox' name='palabras[]' value='" . htmlspecialchars($english) . "'></td>";
                echo "<td>" . htmlspecialchars($english) . "</td>";
                echo "<td>" . htmlspecialchars($spanish) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" value="Traducir Palabras Seleccionadas">
    </form>
</body>
</html>