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

$mensajes = []; // Array para almacenar mensajes de error o resultados

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar la variable 'caracter' con el valor enviado o vacío
    $caracter = isset($_POST["caracter"]) ? trim($_POST["caracter"]) : '';

    // Validar que el campo no esté vacío
    if ($caracter === '') {
        $mensajes[] = "El campo de carácter es obligatorio.";
    } else {
        // Validar que el usuario haya ingresado exactamente un carácter
        if (mb_strlen($caracter, 'UTF-8') != 1) {
            $mensajes[] = "Por favor, introduce exactamente un solo carácter.";
        } else {
            // Comprobar qué tipo de carácter es
            if (esLetraMayuscula($caracter)) {
                $mensajes[] = "El carácter introducido es una letra mayúscula.";
            } elseif (esLetraMinuscula($caracter)) {
                $mensajes[] = "El carácter introducido es una letra minúscula.";
            } elseif (esNumero($caracter)) {
                $mensajes[] = "El carácter introducido es un número.";
            } elseif (esCaracterBlanco($caracter)) {
                $mensajes[] = "El carácter introducido es un carácter en blanco.";
            } elseif (esCaracterPuntuacion($caracter)) {
                $mensajes[] = "El carácter introducido es un carácter de puntuación.";
            } elseif (esCaracterEspecial($caracter)) {
                $mensajes[] = "El carácter introducido es un carácter especial.";
            } else {
                $mensajes[] = "El carácter introducido no pertenece a ninguna de las categorías.";
            }
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
    <h1>Introduce un carácter</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="caracter">Carácter:</label><br>
        <input type="text" name="caracter" id="caracter" maxlength="1" value="<?php echo isset($_POST['caracter']) ? htmlspecialchars($_POST['caracter']) : ''; ?>"><br><br>
        <input type="submit" value="Comprobar">
    </form>
</body>
</html>
