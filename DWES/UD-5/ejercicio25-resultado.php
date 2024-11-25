<?php
session_start();

if (!isset($_SESSION['datos']) || !isset($_SESSION['foto'])) {
    header('Location: ejercicio25.php');
    exit;
}

$datos = $_SESSION['datos'];
$foto = $_SESSION['foto'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario Procesado</title>
</head>

<body>
    <h1>Formulario Procesado con Éxito</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($datos['nombre']) ?></p>
    <p><strong>Nivel de Estudios:</strong> <?= htmlspecialchars($datos['nivel_estudios']) ?></p>
    <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($datos['nacionalidad']) ?></p>
    <p><strong>Idiomas:</strong> <?= implode(', ', $datos['idiomas']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($datos['email']) ?></p>
    <p><strong>Foto subida:</strong></p>
    <img src="<?= htmlspecialchars($foto) ?>" alt="Foto subida" style="max-width: 150px;">
    <br><br>
    <p>Realizado por: <strong>Álvaro Escartí - IES LA SÉNIA - DAW2</strong>
    </p>
</body>

</html>
