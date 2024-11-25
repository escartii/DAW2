<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Resultados del Formulario</title>
</head>
<body>
    <h1>Resultados del Formulario</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h2>Datos recibidos:</h2>";
        echo "<p><i>Nombre:</i> <strong>" . htmlspecialchars($_POST["nombre"]) . "</strong><br>";
        echo "<i>Apellidos:</i> <strong>" . htmlspecialchars($_POST["apellidos"]) . "</strong><br>";
        echo "<i>Email:</i> <strong>" . htmlspecialchars($_POST["email"]) . "</strong><br>";
        echo "<i>Usuario:</i> <strong>" . htmlspecialchars($_POST["usuario"]) . "</strong><br>";
        echo "<i>Password:</i> <strong>" . htmlspecialchars($_POST["password"]) . "</strong><br>";
        echo "<i>Sexo:</i> <strong>" . htmlspecialchars($_POST["sexo"]) . "</strong><br>";
        echo "<i>Provincia:</i> <strong>" . htmlspecialchars($_POST["provincia"]) . "</strong><br>";
        
        if (!empty($_POST["horario"])) {
            echo "<i>Horario de contacto:</i> <strong>" . implode(", ", $_POST["horario"]) . "</strong><br>";
        }
        
        if (!empty($_POST["conocido"])) {
            echo "<i>¿Cómo nos ha conocido?:</i> <strong>" . implode(", ", $_POST["conocido"]) . "</strong><br>";
        }
        
        echo "<i>Tipo de incidencia:</i> <strong>" . htmlspecialchars($_POST["tipo"]) . "</strong><br>";
        echo "<i>Descripción de la incidencia:</i> <strong>" . htmlspecialchars($_POST["descripcion"]) . "</strong></p>";
    }
    ?>
</body>
</html>