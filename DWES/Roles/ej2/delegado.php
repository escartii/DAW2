<?php
// delegado.php
session_start();

// Comprobamos que la sesión existe
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Perfil Delegado</title>
</head>
<body>
  <h1>Bienvenido Delegado</h1>
  <p>
    Hola <strong><?php echo htmlspecialchars($usuario['nombre'] . " " . $usuario['apellido']); ?></strong>,<br>
    has iniciado sesión como <strong>Delegado</strong>.<br>
    Asignatura: <strong><?php echo htmlspecialchars($usuario['asignatura']); ?></strong><br>
    Grupo: <strong><?php echo htmlspecialchars($usuario['grupo']); ?></strong>
  </p>
  <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
