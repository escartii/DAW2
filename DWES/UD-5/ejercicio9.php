<?php

/**
 * @Author: Álvaro Escartí
 */

// Crea la tabla de multiplicar de un número indicado por el usuario siendo que el
// multiplicador se podrá seleccionar entre 1 y 10. Se multiplicará desde 1 al multiplicador
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num = (int)$_POST["num"]; // Cambiar $_GET por $_POST
    // Crear la tabla de multiplicar
    for ($i = 1; $i <= 10; $i++) {
        echo $num . " x " . $i . " = " . $i * $num . "<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="">
        <label for="num">Seleccionar número:</label>
        <select name="num">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <input type="submit" name="enviar">
    </form>
</body>

</html>
