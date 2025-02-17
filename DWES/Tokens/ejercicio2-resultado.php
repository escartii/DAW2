<?php
session_start();

// Si no existen datos guardados en la sesión, se impide el acceso a esta página
if (!isset($_SESSION['datos'])) {
    echo "No se han enviado datos. Acceso no permitido.";
    exit;
}

$datos = $_SESSION['datos'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Datos y Rol</title>
</head>
<body>
    <h1>Datos Recibidos</h1>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($datos['nombre']) ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($datos['edad']) ?></p>
    <p><strong>Rol:</strong> <?= htmlspecialchars($datos['rol']) ?></p>
    <p><strong>Nivel de estudios:</strong> <?= htmlspecialchars($datos['nivel']) ?></p>
    <p><strong>Situación actual:</strong> <?= htmlspecialchars(implode(', ', $datos['situacion'])) ?></p>
    <p><strong>Hobbies:</strong> <?= htmlspecialchars(implode(', ', $datos['hobbies'])) ?></p>
    <p><strong>Otro Hobby:</strong> <?= htmlspecialchars($datos['otro_hobby']) ?></p>
    
    <h2>Token de sesión</h2>
    <p><?= htmlspecialchars($_SESSION['form_token']) ?></p>
</body>
</html>
