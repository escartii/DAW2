<?php
// Iniciar la sesión para manejar cookies
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $accion = $_POST['accion'];

    // Almacenar los valores en una cookie por 1 hora
    setcookie("usuario", $nombre, time() + 3600, "/");
    setcookie("accion", $accion, time() + 3600, "/");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Saludo/Despedida</title>
</head>
<body>

<h2>Formulario de Saludo o Despedida</h2>

<form method="post">
    <label for="nombre">Tu nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br><br>
    <label for="accion">¿Qué deseas?</label>
    <select id="accion" name="accion">
        <option value="saludo">Saludo</option>
        <option value="despedida">Despedida</option>
    </select>
    <br><br>
    <button type="submit">Enviar</button>
</form>

<?php
// Mostrar los valores actuales
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h3>Datos actuales:</h3>";
    echo "<p>Usuario: $nombre</p>";
    echo "<p>Acción seleccionada: $accion</p>";
}

// Mostrar los valores almacenados en cookies (si existen)
if (isset($_COOKIE['usuario']) && isset($_COOKIE['accion'])) {
    echo "<h3>Datos anteriores (almacenados en la cookie):</h3>";
    echo "<p>Usuario anterior: " . $_COOKIE['usuario'] . "</p>";
    echo "<p>Acción anterior: " . $_COOKIE['accion'] . "</p>";
}
?>

</body>
</html>
