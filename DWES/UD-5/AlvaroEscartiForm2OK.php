<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Datos recibidos</title>
    <style>
        /* Estilo para los campos en cursiva y el contenido en negrita */
        .campo {
            font-style: italic;
        }
        .contenido {
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1 style="text-align:center;">Álvaro Escartí - Datos recibidos</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Datos recibidos:</h2>";

    // Mostramos los campos y sus valores con la estructura en negrita y cursiva
    echo "<p><span class='campo'>Nombre:</span> <span class='contenido'>" . htmlspecialchars($_POST['nombre']) . "</span></p>";
    echo "<p><span class='campo'>Apellidos:</span> <span class='contenido'>" . htmlspecialchars($_POST['apellidos']) . "</span></p>";
    echo "<p><span class='campo'>Correo electrónico:</span> <span class='contenido'>" . htmlspecialchars($_POST['email']) . "</span></p>";
    echo "<p><span class='campo'>Usuario:</span> <span class='contenido'>" . htmlspecialchars($_POST['usuario']) . "</span></p>";
    echo "<p><span class='campo'>Password:</span> <span class='contenido'>" . htmlspecialchars($_POST['password']) . "</span></p>";
    echo "<p><span class='campo'>Sexo:</span> <span class='contenido'>" . htmlspecialchars($_POST['sexo']) . "</span></p>";
    echo "<p><span class='campo'>Provincia:</span> <span class='contenido'>" . htmlspecialchars($_POST['provincia']) . "</span></p>";
    echo "<p><span class='campo'>Situación:</span> <span class='contenido'>" . implode(", ", $_POST['situacion']) . "</span></p>";
    echo "<p><span class='campo'>Comentario:</span> <span class='contenido'>" . htmlspecialchars($_POST['comentario']) . "</span></p>";

    // Mostrar el estado de las casillas
    echo "<p><span class='campo'>Desea recibir novedades:</span> <span class='contenido'>" . (isset($_POST['novedades']) ? "Sí" : "No") . "</span></p>";
    echo "<p><span class='campo'>Condiciones aceptadas:</span> <span class='contenido'>" . (isset($_POST['condiciones']) ? "Sí" : "No") . "</span></p>";
}
?>

</body>
</html>
