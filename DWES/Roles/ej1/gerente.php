<?php
session_start();

if (!isset($_SESSION['nombre']) || $_SESSION['perfil'] !== 'gerente') {
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
    <title>Página del Gerente - Empresa XYZ</title>
</head>
<body>
    <h1>Bienvenido, Gerente <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
    <p>Salario Máximo: €<?php echo salarioMaximo($trabajadores); ?></p>
    <p>Salario Mínimo: €<?php echo salarioMinimo($trabajadores); ?></p>
    <p>Salario Medio: €<?php echo number_format(salarioMedio($trabajadores), 2); ?></p>
    <a href="index.php?logout=true">Cerrar Sesión</a>
</body>
</html>