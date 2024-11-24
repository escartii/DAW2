<?php

/**
 * @author Álvaro Escartí
 */
session_start();

// Si no existe el número secreto o los intentos, lo inicializamos
if (!isset($_SESSION['numeroSecreto'])) {
    $_SESSION['numeroSecreto'] = str_pad(rand(0, 9999), 4, "0", STR_PAD_LEFT); // Número secreto aleatorio de 4 dígitos
    $_SESSION['intentos'] = 4; // Intentos iniciales
}

$mensaje = ""; // Mensaje para mostrar al usuario

// Comprobamos si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"]; // Código que introduce el usuario

    // Comprobamos si el código tiene 4 dígitos
    if (strlen($codigo) != 4 || !is_numeric($codigo)) {
        $mensaje = "Por favor, introduce un código de 4 dígitos.";
    } else {
        // Comprobamos si el código es correcto
        if ($codigo == $_SESSION['numeroSecreto']) {
            $mensaje = "¡La caja fuerte se ha abierto satisfactoriamente!";
            session_destroy(); // Si acierta, se reinicia el juego
        } else {
            $_SESSION['intentos']--; // Si falla, resta un intento
            // Si no quedan intentos
            if ($_SESSION['intentos'] <= 0) {
                $mensaje = "Has agotado todos los intentos. El número secreto era: " . $_SESSION['numeroSecreto'];
                session_destroy(); // Reinicia el juego si se acabaron los intentos
            } else {
                $mensaje = "Lo siento, esa no es la combinación. Te quedan " . $_SESSION['intentos'] . " intentos.";
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
    <title>Caja Fuerte</title>
</head>

<body>
    <h1>Caja Fuerte</h1>

    <?php if ($mensaje): ?>
        <div style="color: red;"><?php echo $mensaje; ?></div> <!-- Mostrar mensaje -->
    <?php endif; ?>

    <!-- Si no ha acertado ni se han agotado los intentos, mostramos el formulario -->
    <?php if (!isset($mensaje) || strpos($mensaje, "abierto satisfactoriamente") === false && strpos($mensaje, "agotado todos los intentos") === false): ?>
        <form method="POST" action="">
            <label for="codigo">Introduce el código de la caja fuerte (4 dígitos):</label><br>
            <input type="text" id="codigo" name="codigo" maxlength="4" required>
            <br><br>
            <button type="submit">Abrir</button>
        </form>
    <?php else: ?>
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Intentar de nuevo</a></p>
    <?php endif; ?>
</body>

</html>