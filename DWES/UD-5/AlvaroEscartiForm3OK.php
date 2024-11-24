<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Datos recibidos</title>
</head>
<body>
    <h1>Álvaro Escartí - Datos recibidos del Formulario 3</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h2>Datos recibidos:</h2>";
        echo "<i><strong>Nombre:</strong></i> <strong>" . htmlspecialchars($_POST["nombre"]) . "</strong><br>";
        echo "<i><strong>Apellidos:</strong></i> <strong>" . htmlspecialchars($_POST["apellidos"]) . "</strong><br>";
        echo "<i><strong>Email:</strong></i> <strong>" . htmlspecialchars($_POST["email"]) . "</strong><br>";
        echo "<i><strong>Usuario:</strong></i> <strong>" . htmlspecialchars($_POST["usuario"]) . "</strong><br>";
        echo "<i><strong>Password:</strong></i> <strong>" . htmlspecialchars($_POST["password"]) . "</strong><br>";
        echo "<i><strong>Sexo:</strong></i> <strong>" . htmlspecialchars($_POST["sexo"]) . "</strong><br>";
        echo "<i><strong>Provincia:</strong></i> <strong>" . htmlspecialchars($_POST["provincia"]) . "</strong><br>";

        if (!empty($_POST["horario"])) {
            echo "<i><strong>Horario de contacto:</strong></i> <strong>" . implode(", ", $_POST["horario"]) . "</strong><br>";
        }

        if (!empty($_POST["conocido"])) {
            echo "<i><strong>¿Cómo nos ha conocido?:</strong></i> <strong>" . implode(", ", $_POST["conocido"]) . "</strong><br>";
        }

        echo "<i><strong>Comentario:</strong></i> <strong>" . htmlspecialchars($_POST["comentario"]) . "</strong><br>";

        if (isset($_POST["ofertas"])) {
            echo "<i><strong>Deseo recibir información:</strong></i> <strong>Sí</strong><br>";
        } else {
            echo "<i><strong>Deseo recibir información:</strong></i> <strong>No</strong><br>";
        }

        if (isset($_POST["condiciones"])) {
            echo "<i><strong>Condiciones:</strong></i> <strong>Aceptadas</strong><br>";
        }
    } else {
        echo "<p>No se ha recibido ningún dato.</p>";
    }
    ?>
</body>
</html>
