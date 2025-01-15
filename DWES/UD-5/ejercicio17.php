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
    echo "<table border='1' style='border-collapse: collapse; text-align: center;'>";
    echo "<tr><th>Inglés</th><th>Español</th></tr>";
    
    // Comprobar si se han seleccionado palabras
    if (isset($_POST['palabras'])) {
        // Recorrer las palabras seleccionadas
        foreach ($_POST['palabras'] as $palabra) {
            if (isset($palabras[$palabra])) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($palabra) . "</td>";
                echo "<td>" . htmlspecialchars($palabras[$palabra]) . "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='2'>No seleccionaste ninguna palabra</td></tr>";
    }
    
    echo "</table>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Traductor de Palabras</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        h1, h2 {
            text-align: center;
        }
        form {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Traductor de Palabras Inglés-Español</h1>
    
    <form method="post">
        <table>
            <tr>
                <th>Seleccionar</th>
                <th>Inglés</th>
            </tr>
            <?php
            // Generar filas de la tabla con casillas de verificación
            foreach ($palabras as $english => $spanish) {
                echo "<tr>";
                // Crear casilla de verificación para cada palabra
                echo "<td><input type='checkbox' name='palabras[]' value='" . htmlspecialchars($english) . "'></td>";
                echo "<td>" . htmlspecialchars($english) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" value="Traducir Palabras Seleccionadas">
    </form>
</body>
</html>
