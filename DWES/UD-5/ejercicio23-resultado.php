<?php

/**
 * @Author: Álvaro Escartí
 */

session_start();

if (!isset($_SESSION['datos'])) {
    header('Location: pagina1.php');
    exit;
}

$datos = $_SESSION['datos'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Datos Recogidos</title>
</head>

<body>
    <h1>Datos Recogidos</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($datos['nombre']) ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($datos['edad']) ?></p>
    <p><strong>Nivel de estudios:</strong> <?= htmlspecialchars($datos['nivel']) ?></p>
    <p><strong>Situación actual:</strong> <?= implode(', ', $datos['situacion']) ?></p>
    <p><strong>Hobbies:</strong> <?= implode(', ', $datos['hobbies']) . (!empty($datos['otro_hobby']) ? ', ' . htmlspecialchars($datos['otro_hobby']) : '') ?></p>

    <a href="ejercicio23.php">Volver al formulario</a>
</body>

</html>
