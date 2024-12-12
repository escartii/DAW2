<?php

/**
 * @Author: Álvaro Escartí
 */

$mensajes = []; // Array para almacenar mensajes de error o resultados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar la variable 'numero' con el valor enviado o vacío
    $numero = isset($_POST["numero"]) ? trim($_POST["numero"]) : '';

    // Validar que el campo no esté vacío
    if ($numero === '') {
        $mensajes[] = "El campo número es obligatorio.";
    } else {
        // Verificar que el valor sea un número
        if (is_numeric($numero)) {
            // Convertir a número entero o decimal según corresponda
            $numero = $numero + 0; // Esto convierte la cadena a número

            if ($numero <= 15) {
                $mensajes[] = "Primera quincena.";
            } else {
                $mensajes[] = "Segunda quincena.";
            }
        } else {
            $mensajes[] = "El input no es un número válido.";
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
    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="numero">Introduce un número:</label>
        <input type="text" name="numero" id="numero" value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>"><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>
