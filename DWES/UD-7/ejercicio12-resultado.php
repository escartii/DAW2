<?php

/**
 * @Author: Álvaro Escartí
 */
session_start();

if (!isset($_SESSION['datos'])) {
    // Si no hay datos en la sesión, redirigir al formulario
    header('Location: ejercicio12.php');
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
    <p><strong>Apellidos:</strong> <?= htmlspecialchars($datos['apellidos']) ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($datos['edad']) ?></p>
    <p><strong>Peso:</strong> <?= htmlspecialchars($datos['peso']) ?> kg</p>
    <p><strong>Sexo:</strong> <?= htmlspecialchars($datos['sexo']) ?></p>
    <p><strong>Estado Civil:</strong> <?= htmlspecialchars($datos['estado_civil']) ?></p>
    <p><strong>Aficiones:</strong> <?= implode(', ', $datos['aficiones']) ?></p>
    <br>
    <a href="ejercicio12.php">Volver al formulario</a>
</body>
</html>