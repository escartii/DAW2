<?php

/**
 * @Author: Álvaro Escartí Lamolda
 */

// Recuperar los valores anteriores antes de sobrescribir
$datos_anteriores = isset($_COOKIE['datos_usuario']) ? json_decode($_COOKIE['datos_usuario'], true) : [
    'nombre' => 'Ninguno',
    'idioma' => 'Ninguno',
    'color' => 'Ninguno',
    'ciudad' => 'Ninguna'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre']) && isset($_POST['idioma']) && isset($_POST['color']) && isset($_POST['ciudad'])) {
    // Obtener los valores enviados por el formulario
    $nombre_actual = $_POST['nombre'];
    $idioma_actual = $_POST['idioma'];
    $color_actual = $_POST['color'];
    $ciudad_actual = $_POST['ciudad'];

    // Crear un array con los datos actuales
    $datos_usuario = array(
        'nombre' => $nombre_actual,
        'idioma' => $idioma_actual,
        'color' => $color_actual,
        'ciudad' => $ciudad_actual
    );

    // Convertir el array a JSON
    $datos_json = json_encode($datos_usuario);

    // Guardar los datos en una cookie
    setcookie("datos_usuario", $datos_json, time() + 3600); // Cookie válida por 1 hora

    // Redirigir para evitar el reenvío del formulario al recargar
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} else {
    $nombre_actual = $datos_anteriores['nombre'];
    $idioma_actual = $datos_anteriores['idioma'];
    $color_actual = $datos_anteriores['color'];
    $ciudad_actual = $datos_anteriores['ciudad'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí Lamolda</title>
</head>
<body>
    <h1>Formulario de Preferencias</h1>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label for="idioma">Preferencia de idioma:</label>
        <select id="idioma" name="idioma" required>
            <option value="español">Español</option>
            <option value="inglés">Inglés</option>
            <option value="francés">Francés</option>
            <option value="alemán">Alemán</option>
        </select>
        <br><br>
        <label for="color">Color favorito:</label>
        <input type="color" id="color" name="color" required>
        <br><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

    <h2>Datos actuales:</h2>
    <p>Nombre: <?php echo htmlspecialchars($nombre_actual); ?></p>
    <p>Idioma: <?php echo htmlspecialchars($idioma_actual); ?></p>
    <p>Color: <span style="background-color: <?php echo htmlspecialchars($color_actual); ?>; padding: 5px;"><?php echo htmlspecialchars($color_actual); ?></span></p>
    <p>Ciudad: <?php echo htmlspecialchars($ciudad_actual); ?></p>

    <h2>Datos anteriores (cookies):</h2>
    <p>Nombre anterior: <?php echo htmlspecialchars($datos_anteriores['nombre']); ?></p>
    <p>Idioma anterior: <?php echo htmlspecialchars($datos_anteriores['idioma']); ?></p>
    <p>Color anterior: <span style="background-color: <?php echo htmlspecialchars($datos_anteriores['color']); ?>; padding: 5px;"><?php echo htmlspecialchars($datos_anteriores['color']); ?></span></p>
    <p>Ciudad anterior: <?php echo htmlspecialchars($datos_anteriores['ciudad']); ?></p>
</body>
</html>