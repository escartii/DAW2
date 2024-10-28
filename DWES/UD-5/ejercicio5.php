<?php

/**
 * @Author: Álvaro Escartí
 */

// Función para comprobar si es una letra mayúscula
function esLetraMayuscula($caracter) {
    return ctype_upper($caracter);
}

// Función para comprobar si es una letra minúscula
function esLetraMinuscula($caracter) {
    return ctype_lower($caracter);
}

// Función para comprobar si es un número
function esNumero($caracter) {
    return ctype_digit($caracter);
}

// Función para comprobar si es un carácter en blanco (espacio, tabulación, etc.)
function esCaracterBlanco($caracter) {
    return ctype_space($caracter);
}

// Función para comprobar si es un carácter de puntuación
function esCaracterPuntuacion($caracter) {
    return ctype_punct($caracter);
}

// Función para comprobar si es un carácter especial
function esCaracterEspecial($caracter) {
    return !ctype_alnum($caracter) && !ctype_space($caracter) && !ctype_punct($caracter);
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caracter = $_POST["caracter"];

    // Validar que el usuario haya ingresado exactamente un carácter
    if (strlen($caracter) != 1) {
        echo "Por favor, introduce un solo carácter.<br>";
    } else {
        // Comprobar qué tipo de carácter es
        if (esLetraMayuscula($caracter)) {
            echo "El carácter introducido es una letra mayúscula.<br>";
        } elseif (esLetraMinuscula($caracter)) {
            echo "El carácter introducido es una letra minúscula.<br>";
        } elseif (esNumero($caracter)) {
            echo "El carácter introducido es un número.<br>";
        } elseif (esCaracterBlanco($caracter)) {
            echo "El carácter introducido es un carácter en blanco.<br>";
        } elseif (esCaracterPuntuacion($caracter)) {
            echo "El carácter introducido es un carácter de puntuación.<br>";
        } elseif (esCaracterEspecial($caracter)) {
            echo "El carácter introducido es un carácter especial.<br>";
        } else {
            echo "El carácter introducido no pertenece a ninguna de las categorías.<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificación de Caracteres</title>
</head>
<body>
    <h1>Introduce un carácter</h1>
    <form method="POST" action="">
        <label for="caracter">Carácter:</label><br>
        <input type="text" name="caracter" id="caracter" maxlength="1" required><br><br>
        <input type="submit" value="Comprobar">
    </form>
</body>
</html>
