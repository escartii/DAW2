<?php
/**
 * @Author: Álvaro Escartí
 */
session_start();

// Si no existe el número secreto o los intentos, lo inicializamos
if (!isset($_SESSION['numeroSecreto'])) {
    $_SESSION['numeroSecreto'] = str_pad(rand(0, 9999), 4, "0", STR_PAD_LEFT); // Número secreto aleatorio de 4 dígitos
    $_SESSION['intentos'] = 4; // Intentos iniciales
}

$mensaje = ""; // Mensaje para mostrar al usuario
$codigoIngresado = ""; // Variable para preservar el código ingresado

// Comprobamos si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar el código ingresado por el usuario
    $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : '';
    $codigoIngresado = $codigo; // Preservar el código ingresado

    // Validar que el usuario haya ingresado algo
    if ($codigo === '') {
        $mensaje = "Por favor, introduce un código de 4 dígitos.";
    }
    // Validar que el código tenga exactamente 4 dígitos
    elseif (strlen($codigo) != 4 || !ctype_digit($codigo)) {
        $mensaje = "El código debe tener exactamente 4 dígitos numéricos.";
    }
    else {
        // Comprobar si el código es correcto
        if ($codigo === $_SESSION['numeroSecreto']) {
            $mensaje = "¡La caja fuerte se ha abierto satisfactoriamente!";
            session_destroy(); // Si acierta, se reinicia el juego
        } else {
            $_SESSION['intentos']--; // Si falla, resta un intento
            // Si no quedan intentos
            if ($_SESSION['intentos'] <= 0) {
                $mensaje = "Has agotado todos los intentos. El número secreto era: " . $_SESSION['numeroSecreto'] . ".";
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
        <div>
            <p><?php echo htmlspecialchars($mensaje); ?></p>
        </div>
    <?php endif; ?>

    <!-- Si no ha acertado ni se han agotado los intentos, mostramos el formulario -->
    <?php if (!($mensaje === "¡La caja fuerte se ha abierto satisfactoriamente!" || strpos($mensaje, "agotado todos los intentos") !== false)): ?>
        <form method="POST" action="">
            <label for="codigo">Introduce el código de la caja fuerte (4 dígitos):</label><br>
            <input type="text" id="codigo" name="codigo" maxlength="4" value="<?php echo htmlspecialchars($codigoIngresado); ?>"><br><br>
            <input type="submit" value="Abrir">
        </form>
    <?php else: ?>
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Intentar de nuevo</a></p>
    <?php endif; ?>
</body>
</html>
