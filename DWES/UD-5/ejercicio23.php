<?php

/**
 * @Author: Álvaro Escartí
 */

$errores = [];
$valores = [
    'nombre' => '',
    'edad' => '',
    'nivel' => '',
    'situacion' => [],
    'hobbies' => [],
    'otro_hobby' => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos enviados
    $valores['nombre'] = trim($_POST['nombre']);
    $valores['edad'] = trim($_POST['edad']);
    $valores['nivel'] = $_POST['nivel'] ?? '';
    $valores['situacion'] = $_POST['situacion'] ?? [];
    $valores['hobbies'] = $_POST['hobbies'] ?? [];
    $valores['otro_hobby'] = trim($_POST['otro_hobby']);

    // Validación de datos
    if (empty($valores['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio.';
    }
    if (!is_numeric($valores['edad']) || $valores['edad'] <= 0) {
        $errores['edad'] = 'La edad debe ser un número positivo.';
    }
    if (empty($valores['nivel'])) {
        $errores['nivel'] = 'Debe seleccionar un nivel de estudios.';
    }
    if (empty($valores['situacion'])) {
        $errores['situacion'] = 'Debe seleccionar al menos una situación.';
    }

    // Si no hay errores, redirigir a la segunda página con los datos
    if (empty($errores)) {
        session_start();
        $_SESSION['datos'] = $valores;
        header('Location: ejercicio23-resultado.php');
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
    <h1>Recogida de Datos Personales</h1>

    <form action="" method="post">
        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($valores['nombre']) ?>">
        <span style="color: red;"><?= $errores['nombre'] ?? '' ?></span>
        <br><br>

        <!-- Edad -->
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" value="<?= htmlspecialchars($valores['edad']) ?>">
        <span style="color: red;"><?= $errores['edad'] ?? '' ?></span>
        <br><br>

        <!-- Nivel de estudios -->
        <label for="nivel">Nivel de estudios:</label>
        <select name="nivel" id="nivel">
            <option value="">Seleccione...</option>
            <option value="primaria" <?= $valores['nivel'] == 'primaria' ? 'selected' : '' ?>>Primaria</option>
            <option value="secundaria" <?= $valores['nivel'] == 'secundaria' ? 'selected' : '' ?>>Secundaria</option>
            <option value="universidad" <?= $valores['nivel'] == 'universidad' ? 'selected' : '' ?>>Universidad</option>
        </select>
        <span style="color: red;"><?= $errores['nivel'] ?? '' ?></span>
        <br><br>

        <!-- Situación actual -->
        <label>Situación actual:</label><br>
        <label><input type="checkbox" name="situacion[]" value="estudiando" <?= in_array('estudiando', $valores['situacion']) ? 'checked' : '' ?>> Estudiando</label><br>
        <label><input type="checkbox" name="situacion[]" value="trabajando" <?= in_array('trabajando', $valores['situacion']) ? 'checked' : '' ?>> Trabajando</label><br>
        <label><input type="checkbox" name="situacion[]" value="buscando empleo" <?= in_array('buscando empleo', $valores['situacion']) ? 'checked' : '' ?>> Buscando empleo</label><br>
        <label><input type="checkbox" name="situacion[]" value="desempleado" <?= in_array('desempleado', $valores['situacion']) ? 'checked' : '' ?>> Desempleado</label><br>
        <span style="color: red;"><?= $errores['situacion'] ?? '' ?></span>
        <br><br>

        <!-- Hobbies -->
        <label>Hobbies:</label><br>
        <label><input type="checkbox" name="hobbies[]" value="leer" <?= in_array('leer', $valores['hobbies']) ? 'checked' : '' ?>> Leer</label><br>
        <label><input type="checkbox" name="hobbies[]" value="deportes" <?= in_array('deportes', $valores['hobbies']) ? 'checked' : '' ?>> Deportes</label><br>
        <label><input type="checkbox" name="hobbies[]" value="música" <?= in_array('música', $valores['hobbies']) ? 'checked' : '' ?>> Música</label><br>
        <label for="otro_hobby">Otro:</label>
        <input type="text" name="otro_hobby" id="otro_hobby" value="<?= htmlspecialchars($valores['otro_hobby']) ?>">
        <br><br>

        <!-- Botones -->
        <button type="submit">Enviar</button>
    </form>
</body>

</html>