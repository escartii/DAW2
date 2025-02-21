<?php

/**
 * @Author: Álvaro Escarti Lamolda
 */

// Recuperar los valores anteriores antes de sobrescribir
$nombre_anterior = isset($_COOKIE['datos_usuario']) ? json_decode($_COOKIE['datos_usuario'], true)['nombre'] : 'Ninguno';
$accion_anterior = isset($_COOKIE['datos_usuario']) ? json_decode($_COOKIE['datos_usuario'], true)['accion'] : 'Ninguna';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre']) && isset($_POST['accion'])) {
    // Obtener los valores enviados por el formulario
    $nombre_actual = $_POST['nombre'];
    $accion_actual = $_POST['accion'];

    // Crear un array con los datos actuales
    $datos_usuario = array(
        'nombre' => $nombre_actual,
        'accion' => $accion_actual
    );

    // Convertir el array a JSON
    $datos_json = json_encode($datos_usuario);

    // Guardar los datos en una cookie
    setcookie("datos_usuario", $datos_json, time() + 3600); // Cookie válida por 1 hora

    // Redirigir para evitar el reenvío del formulario al recargar
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
} else {
    $nombre_actual = $nombre_anterior;
    $accion_actual = $accion_anterior;
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
    <h1>Formulario de Saludo/Despedida</h1>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label for="accion">Seleccione una acción:</label>
        <select id="accion" name="accion" required>
            <option value="saludo">Saludo</option>
            <option value="despedida">Despedida</option>
        </select>
        <br><br>
        <input type="submit" value="Enviar">
    </form>

    <h2>Datos actuales:</h2>
    <p>Nombre: <?php echo htmlspecialchars($nombre_actual); ?></p>
    <p>Acción: <?php echo htmlspecialchars($accion_actual); ?></p>

    <h2>Datos anteriores (cookies):</h2>
    <p>Nombre anterior: <?php echo htmlspecialchars($nombre_anterior); ?></p>
    <p>Acción anterior: <?php echo htmlspecialchars($accion_anterior); ?></p>
</body>
</html>