<?php

/**
 * @Author: Álvaro Escartí
 */

$errores = [];
$valores = [
    'nombre' => '',
    'password' => '',
    'nivel_estudios' => '',
    'nacionalidad' => '',
    'idiomas' => [],
    'email' => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $valores['nombre'] = trim($_POST['nombre']);
    $valores['password'] = $_POST['password'];
    $valores['nivel_estudios'] = $_POST['nivel_estudios'] ?? '';
    $valores['nacionalidad'] = $_POST['nacionalidad'] ?? '';
    $valores['idiomas'] = $_POST['idiomas'] ?? [];
    $valores['email'] = trim($_POST['email']);

    // Validaciones
    if (empty($valores['nombre'])) {
        $errores['nombre'] = 'El nombre completo es obligatorio.';
    }
    if (strlen($valores['password']) < 6) {
        $errores['password'] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if (empty($valores['nivel_estudios'])) {
        $errores['nivel_estudios'] = 'Debe seleccionar un nivel de estudios.';
    }
    if (empty($valores['nacionalidad'])) {
        $errores['nacionalidad'] = 'Debe seleccionar una nacionalidad.';
    }
    if (empty($valores['idiomas'])) {
        $errores['idiomas'] = 'Debe seleccionar al menos un idioma.';
    }
    if (!filter_var($valores['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El email no es válido.';
    }

    // Validación de archivo
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != UPLOAD_ERR_OK) {
        $errores['foto'] = 'Debe adjuntar una foto.';
    } else {
        $archivo = $_FILES['foto'];
        $extensiones_validas = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $extensiones_validas)) {
            $errores['foto'] = 'El archivo debe tener una extensión válida (jpg, png, gif).';
        } elseif ($archivo['size'] > 50 * 1024) {
            $errores['foto'] = 'El archivo debe pesar menos de 50 KB.';
        } else {
            $directorio = 'uploads';
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }

            $nombre_unico = uniqid() . '.' . $extension;
            $ruta = $directorio . '/' . $nombre_unico;

            if (!move_uploaded_file($archivo['tmp_name'], $ruta)) {
                $errores['foto'] = 'No se pudo guardar el archivo.';
            }
        }
    }

    // Si no hay errores, guardar los datos y redirigir
    if (empty($errores)) {
        session_start();
        $_SESSION['datos'] = $valores;
        $_SESSION['foto'] = $ruta;
        header('Location: ejercicio25-resultado.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro</title>
</head>

<body>
    <h1>Formulario de Registro</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- Nombre -->
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($valores['nombre']) ?>">
        <span style="color: red;"><?= $errores['nombre'] ?? '' ?></span>
        <br><br>

        <!-- Contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        <span style="color: red;"><?= $errores['password'] ?? '' ?></span>
        <br><br>

        <!-- Nivel de Estudios -->
        <label for="nivel_estudios">Nivel de Estudios:</label>
        <select name="nivel_estudios" id="nivel_estudios">
            <option value="">Seleccione...</option>
            <option value="sin_estudios" <?= $valores['nivel_estudios'] == 'sin_estudios' ? 'selected' : '' ?>>Sin estudios
            </option>
            <option value="eso" <?= $valores['nivel_estudios'] == 'ESO' ? 'selected' : '' ?>>Educación Secundaria
                Obligatoria</option>
            <option value="bachillerato" <?= $valores['nivel_estudios'] == 'bachillerato' ? 'selected' : '' ?>>Bachillerato
            </option>
            <option value="fp" <?= $valores['nivel_estudios'] == 'FP' ? 'selected' : '' ?>>Formación Profesional</option>
            <option value="universidad" <?= $valores['nivel_estudios'] == 'universidad' ? 'selected' : '' ?>>Estudios
                Universitarios</option>
        </select>
        <span style="color: red;"><?= $errores['nivel_estudios'] ?? '' ?></span>
        <br><br>

        <!-- Nacionalidad -->
        <label>Nacionalidad:</label><br>
        <label><input type="radio" name="nacionalidad" value="española" <?= $valores['nacionalidad'] == 'española' ? 'checked' : '' ?>> Española</label><br>
        <label><input type="radio" name="nacionalidad" value="otra" <?= $valores['nacionalidad'] == 'otra' ? 'checked' : '' ?>> Otra</label>
        <span style="color: red;"><?= $errores['nacionalidad'] ?? '' ?></span>
        <br><br>

        <!-- Idiomas -->
        <label>Idiomas:</label><br>
        <?php
        $idiomas = ['español', 'inglés', 'francés', 'alemán', 'italiano'];
        foreach ($idiomas as $idioma) {
            echo "<label><input type='checkbox' name='idiomas[]' value='$idioma'" .
                (in_array($idioma, $valores['idiomas']) ? ' checked' : '') .
                "> $idioma</label><br>";
        }
        ?>
        <span style="color: red;"><?= $errores['idiomas'] ?? '' ?></span>
        <br><br>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($valores['email']) ?>">
        <span style="color: red;"><?= $errores['email'] ?? '' ?></span>
        <br><br>

        <!-- Adjuntar Foto -->
        <label for="foto">Adjuntar Foto:</label>
        <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png,.gif">
        <span style="color: red;"><?= $errores['foto'] ?? '' ?></span>
        <br><br>

        <!-- Botones -->
        <button type="submit">Enviar</button>
        <button type="reset">Borrar</button>
    </form>
</body>

</html>