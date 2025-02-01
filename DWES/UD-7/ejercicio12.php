<?php

/**
 * @Author: Álvaro Escartí
 */
session_start();

$errores = [];
$valores = [
    'nombre' => '',
    'apellidos' => '',
    'edad' => '',
    'peso' => '',
    'sexo' => '',
    'estado_civil' => '',
    'aficiones' => [],
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos enviados
    $valores['nombre'] = trim($_POST['nombre']);
    $valores['apellidos'] = trim($_POST['apellidos']);
    $valores['edad'] = trim($_POST['edad']);
    $valores['peso'] = trim($_POST['peso']);
    $valores['sexo'] = $_POST['sexo'] ?? '';
    $valores['estado_civil'] = $_POST['estado_civil'] ?? '';
    $valores['aficiones'] = $_POST['aficiones'] ?? [];

    // Validación de datos
    if (empty($valores['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio.';
    }
    if (empty($valores['apellidos'])) {
        $errores['apellidos'] = 'Los apellidos son obligatorios.';
    }
    if (!is_numeric($valores['edad']) || $valores['edad'] <= 0 || $valores['edad'] > 120) {
        $errores['edad'] = 'La edad debe ser un número entre 1 y 120.';
    }
    if (!is_numeric($valores['peso']) || $valores['peso'] < 10 || $valores['peso'] > 150) {
        $errores['peso'] = 'El peso debe ser un número entre 10 y 150.';
    }
    if (empty($valores['sexo'])) {
        $errores['sexo'] = 'Debe seleccionar su sexo.';
    }
    if (empty($valores['estado_civil'])) {
        $errores['estado_civil'] = 'Debe seleccionar un estado civil.';
    }

    // Si no hay errores, redirigir a la segunda página con los datos
    if (empty($errores)) {
        $_SESSION['datos'] = $valores; // Guardar datos en la sesión
        header('Location: ejercicio12-resultado.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Datos</title>
</head>
<body>
    <h1>Recogida de Datos</h1>

    <form action="" method="post">
        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($valores['nombre']) ?>">
        <span style="color: red;"><?= $errores['nombre'] ?? '' ?></span>
        <br><br>

        <!-- Apellidos -->
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($valores['apellidos']) ?>">
        <span style="color: red;"><?= $errores['apellidos'] ?? '' ?></span>
        <br><br>

        <!-- Edad -->
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" value="<?= htmlspecialchars($valores['edad']) ?>">
        <span style="color: red;"><?= $errores['edad'] ?? '' ?></span>
        <br><br>

        <!-- Peso -->
        <label for="peso">Peso:</label>
        <input type="number" name="peso" id="peso" step="0.1" value="<?= htmlspecialchars($valores['peso']) ?>">
        <span style="color: red;"><?= $errores['peso'] ?? '' ?></span>
        <br><br>

        <!-- Sexo -->
        <label>Sexo:</label><br>
        <label><input type="radio" name="sexo" value="masculino" <?= $valores['sexo'] == 'masculino' ? 'checked' : '' ?>>
            Masculino</label><br>
        <label><input type="radio" name="sexo" value="femenino" <?= $valores['sexo'] == 'femenino' ? 'checked' : '' ?>>
            Femenino</label><br>
        <span style="color: red;"><?= $errores['sexo'] ?? '' ?></span>
        <br><br>

        <!-- Estado civil -->
        <label for="estado_civil">Estado civil:</label>
        <select name="estado_civil" id="estado_civil">
            <option value="">Seleccione...</option>
            <option value="soltero" <?= $valores['estado_civil'] == 'soltero' ? 'selected' : '' ?>>Soltero</option>
            <option value="casado" <?= $valores['estado_civil'] == 'casado' ? 'selected' : '' ?>>Casado</option>
            <option value="viudo" <?= $valores['estado_civil'] == 'viudo' ? 'selected' : '' ?>>Viudo</option>
            <option value="divorciado" <?= $valores['estado_civil'] == 'divorciado' ? 'selected' : '' ?>>Divorciado
            </option>
            <option value="otro" <?= $valores['estado_civil'] == 'otro' ? 'selected' : '' ?>>Otro</option>
        </select>
        <span style="color: red;"><?= $errores['estado_civil'] ?? '' ?></span>
        <br><br>

        <!-- Aficiones -->
        <label>Aficiones:</label><br>
        <?php
        $aficiones = ['cine', 'deporte', 'literatura', 'música', 'cómics', 'series', 'videojuegos'];
        foreach ($aficiones as $aficion) {
            echo "<label><input type='checkbox' name='aficiones[]' value='$aficion'" .
                (in_array($aficion, $valores['aficiones']) ? ' checked' : '') .
                "> $aficion</label><br>";
        }
        ?>
        <br>

        <!-- Botones -->
        <button type="submit">Enviar</button>
        <button type="reset">Borrar</button>
    </form>
</body>
</html>