<?php

/**
 * @Author: Álvaro Escartí
 */

$mensajes = []; // Array para almacenar mensajes de error o resultados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializar variables con los valores enviados o vacío
    $opcion = isset($_POST["opcion"]) ? $_POST["opcion"] : '';
    $cantidad = isset($_POST["cantidad"]) ? trim($_POST["cantidad"]) : '';

    // Validar que 'opcion' esté seleccionada
    if ($opcion === '') {
        $mensajes[] = "Debe seleccionar una opción de conversión.";
    } else {
        // Validar que 'cantidad' no esté vacía
        if ($cantidad === '') {
            $mensajes[] = "El campo 'cantidad' es obligatorio.";
        } else {
            // Verificar que 'cantidad' sea un número válido
            if (is_numeric($cantidad)) {
                // Realizar la conversión según la opción seleccionada
                if ($opcion == 1) {
                    $euros = $cantidad;
                    $pesetas = $euros * 166.386;
                    $pesetas = number_format($pesetas, 2); // Formatear a 2 decimales
                    $mensajes[] = "$euros euros son $pesetas pesetas.";
                } elseif ($opcion == 2) {
                    $pesetas = $cantidad;
                    $euros = $pesetas / 166.386;
                    $euros = number_format($euros, 2); // Formatear a 2 decimales
                    $mensajes[] = "El resultado de convertir $pesetas pesetas a euros es: $euros €.";
                } else {
                    $mensajes[] = "Opción no válida. Por favor, selecciona 1 o 2.";
                }
            } else {
                $mensajes[] = "Entrada no válida. Por favor, introduce un número válido en 'cantidad'.";
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
    <title>Conversor Euros - Pesetas</title>
</head>
<body>
    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h1>Conversión entre Euros y Pesetas</h1>
    <form method="POST" action="">
        <label for="opcion">Elige la dirección de conversión:</label><br>
        
        <input type="radio" id="euros_a_pesetas" name="opcion" value="1" 
            <?php echo (isset($_POST['opcion']) && $_POST['opcion'] == '1') ? 'checked' : ''; ?>>
        <label for="euros_a_pesetas">Euros a Pesetas</label><br>

        <input type="radio" id="pesetas_a_euros" name="opcion" value="2" 
            <?php echo (isset($_POST['opcion']) && $_POST['opcion'] == '2') ? 'checked' : ''; ?>>
        <label for="pesetas_a_euros">Pesetas a Euros</label><br><br>

        <label for="cantidad">Introduce la cantidad a convertir:</label><br>
        <input type="text" id="cantidad" name="cantidad" 
            value="<?php echo isset($_POST['cantidad']) ? htmlspecialchars($_POST['cantidad']) : ''; ?>"><br><br>

        <input type="submit" value="Convertir">
    </form>
</body>
</html>
