<?php
session_start();

if (!isset($_SESSION['nombre']) || $_SESSION['perfil'] !== 'nominas') {
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
    <title>Página del Responsable de Nóminas - Empresa XYZ</title>
</head>
<body>
    <h1>Bienvenido, Responsable de Nóminas <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
    <p>Salario Máximo: €<?php echo salarioMaximo($trabajadores); ?></p>
    <p>Salario Mínimo: €<?php echo salarioMinimo($trabajadores); ?></p>
    <a href="index.php?logout=true">Cerrar Sesión</a>
</body>
</html>