<?php

/**
 * @Author: Álvaro Escartí
 */


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso = $_POST['curso'];
    $modulos = $_POST['modulos'];
    $dias = isset($_POST['dias']) ? $_POST['dias'] : [];

    if (!empty($dias) && !empty($modulos)) {
        echo "<h2>Horario de $curso</h2>";
        echo "<table>";
        echo "<tr><th>Día</th>";

        // Generar cabecera de horas
        for ($hora = 8; $hora <= 15; $hora++) {
            echo "<th>$hora:00 - " . ($hora + 1) . ":00</th>";
        }
        echo "</tr>";

        // Generar filas para cada día seleccionado
        foreach ($dias as $dia) {
            echo "<tr>";
            echo "<td>$dia</td>";

            // Asignar módulos aleatoriamente a las horas
            for ($hora = 8; $hora <= 15; $hora++) {
                $modulo = !empty($modulos) ? $modulos[array_rand($modulos)] : "-";
                echo "<td>$modulo</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Generador de Horario</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Generador de Horario Escolar</h1>

    <form method="post">
        <h2>Seleccione el Curso:</h2>
        <input type="radio" id="1DAM" name="curso" value="1DAM" required>
        <label for="1DAM">1º DAM</label>
        <input type="radio" id="2DAM" name="curso" value="2DAM">
        <label for="2DAM">2º DAM</label>

        <h2>Seleccione Módulos:</h2>
        <select name="modulos[]" multiple size="5" required>
            <option value="Programación">Programación</option>
            <option value="Bases de Datos">Bases de Datos</option>
            <option value="Entornos de Desarrollo">Entornos de Desarrollo</option>
            <option value="Sistemas Informáticos">Sistemas Informáticos</option>
            <option value="Lenguajes de Marcas">Lenguajes de Marcas</option>
        </select>

        <h2>Seleccione Horas:</h2>
        <input type="checkbox" id="lunes" name="dias[]" value="Lunes">
        <label for="lunes">Lunes</label>
        <input type="checkbox" id="martes" name="dias[]" value="Martes">
        <label for="martes">Martes</label>
        <input type="checkbox" id="miercoles" name="dias[]" value="Miércoles">
        <label for="miercoles">Miércoles</label>
        <input type="checkbox" id="jueves" name="dias[]" value="Jueves">
        <label for="jueves">Jueves</label>
        <input type="checkbox" id="viernes" name="dias[]" value="Viernes">
        <label for="viernes">Viernes</label>

        <br><br>
        <input type="submit" value="Generar Horario">
    </form>
</body>

</html>