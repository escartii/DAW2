<?php
session_start();

if (!isset($_SESSION['nombre']) || $_SESSION['perfil'] !== 'sindicalista') {
    header("Location: index.php");
    exit();
}

include 'funciones.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página del Sindicalista - Empresa XYZ</title>
</head>
<body>
    <h1>Bienvenido, Sindicalista <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
    <p>Salario Medio: €<?php echo number_format(salarioMedio($trabajadores), 2); ?></p>
    <a href="index.php?logout=true">Cerrar Sesión</a>
</body>
</html>