<?php

$nombre = null;
$pass = null;
$nivel = null;
$nacionalidad = null;
$email = null;
$idiomas = [];
$fotoAnterior = null;
$maxSize = 50 * 1024;
$errores = [];

$carpeta = "uploads/";

// Verificamos que se haya enviado el formulario por POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Procesar los datos del formulario
    if (isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']);
    }
    if (isset($_POST['pass'])) {
        $pass = trim($_POST['pass']);
    }
    if (isset($_POST['nivel'])) {
        $nivel = $_POST['nivel'];
    }
    if (isset($_POST['nacionalidad'])) {
        $nacionalidad = $_POST['nacionalidad'];
    }
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }

    if (isset($_POST['idiomas'])) {
        $idiomas = $_POST['idiomas'];
    } else {
        $idiomas = [];
    }

    if (isset($_POST['fotoAnterior'])) {
        $fotoAnterior = $_POST['fotoAnterior'];
    }

    // --- VALIDACIONES ---

    if (empty($nombre)) {
        $errores[] = "El nombre completo es obligatorio";
    } else if (!ctype_alpha(str_replace(' ', '', $nombre))) {
        $errores[] = "El nombre completo solo puede contener letras y espacios";
    }

    if (empty($pass) || strlen($pass) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    }

    $nivelesValidos = [
        "Sin estudios",
        "Educación Secundaria Obligatoria",
        "Bachillerato",
        "Formación Profesional",
        "Estudios Universitarios"
    ];
    if (empty($nivel) || !in_array($nivel, $nivelesValidos)) {
        $errores[] = "Selecciona un nivel de estudios válido";
    }

    if (empty($nacionalidad) || ($nacionalidad != "Española" && $nacionalidad != "Otra")) {
        $errores[] = "La nacionalidad debe ser 'Española' u 'Otra'";
    }

    if (empty($email)) {
        $errores[] = "El email es obligatorio";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del email no es válido";
    }

    if (empty($idiomas)) {
        $errores[] = "Debes seleccionar al menos un idioma";
    }

    // Comprobamos si se ha subido foto nueva o no
    $nuevaFotoSubida = false;

    if (empty($fotoAnterior)) {
        // Si no había foto antes, es obligatorio subir una ahora
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
            $errores[] = "Debes subir una foto";
        } else {
            $nuevaFotoSubida = true;
        }
    } else {
        // Si había foto antes, verificamos si suben otra
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $nuevaFotoSubida = true;
        }
    }

    // Si han subido una foto, validamos el tamaño y la extensión
    if ($nuevaFotoSubida) {
        if ($_FILES['foto']['size'] > $maxSize) {
            $errores[] = "La foto excede el tamaño máximo (50KB)";
        }

        $nombreOriginal = $_FILES['foto']['name'];
        $info = pathinfo($nombreOriginal);
        $ext = "";
        if (isset($info['extension'])) {
            $ext = strtolower($info['extension']);
        }
        if ($ext != "jpg" && $ext != "gif" && $ext != "png") {
            $errores[] = "La extensión de la imagen no es válida (usa jpg, gif o png)";
        }
    }

    // Si no hay errores y se subió una foto, la guardamos
    if (count($errores) == 0 && $nuevaFotoSubida) {
        $nuevoNombre = uniqid("img_") . "." . $ext;
        $rutaDestino = $carpeta . $nuevoNombre;

        $subidaOk = move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
        if ($subidaOk) {
            // Si hay foto anterior, la eliminamos
            if (!empty($fotoAnterior) && file_exists($fotoAnterior)) {
                unlink($fotoAnterior);
            }
            $fotoAnterior = $rutaDestino;
        } else {
            $errores[] = "Error al mover la foto al directorio de destino";
        }
    }

    // Si todo está bien y la acción es "Enviar", redirigimos con los datos
    if (isset($_POST['Enviar']) && count($errores) == 0) {
        // si es un array tengo que ponerle implode y separarlo por comas
        $idiomasStr = implode(",", $idiomas);
        $url = "resultado.php?";
        $url .= "nombre=" . urlencode($nombre);
        $url .= "&pass=" . urlencode($pass);
        $url .= "&nivel=" . urlencode($nivel);
        $url .= "&nacionalidad=" . urlencode($nacionalidad);
        $url .= "&email=" . urlencode($email);
        $url .= "&idiomas=" . urlencode($idiomasStr);
        $url .= "&foto=" . urlencode($fotoAnterior);

        header("Location: $url");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario con Validaciones</title>
    <style>
        .error {
            color: red;
        }

        .ok {
            color: green;
        }
    </style>
</head>

<body>

    <h1>Formulario de Registro</h1>

    <?php
    // Si hay errores, los mostramos
    if (count($errores) > 0) {
        echo "<ul class='error'>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } elseif (isset($_POST['Validar']) && count($errores) == 0) {
        // Si validamos y no hay errores, mostramos un mensaje de éxito
        echo "<p class='ok'>Formulario validado correctamente.</p>";
    }
    ?>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label>Nombre completo:</label><br>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        </p>

        <p>
            <label>Contraseña (mín. 6 car.):</label><br>
            <input type="password" name="pass" value="<?php echo htmlspecialchars($pass); ?>">
        </p>

        <p>
            <label>Nivel de estudios:</label><br>
            <select name="nivel">
                <option value="">Seleccione...</option>
                <option <?php if ($nivel == "Sin estudios")
                    echo "selected"; ?>>Sin estudios</option>
                <option <?php if ($nivel == "Educación Secundaria Obligatoria")
                    echo "selected"; ?>>Educación Secundaria
                    Obligatoria</option>
                <option <?php if ($nivel == "Bachillerato")
                    echo "selected"; ?>>Bachillerato</option>
                <option <?php if ($nivel == "Formación Profesional")
                    echo "selected"; ?>>Formación Profesional</option>
                <option <?php if ($nivel == "Estudios Universitarios")
                    echo "selected"; ?>>Estudios Universitarios
                </option>
            </select>
        </p>

        <p>
            <label>Nacionalidad:</label><br>
            <input type="radio" name="nacionalidad" value="Española" <?php if ($nacionalidad == "Española")
                echo "checked"; ?>> Española
            <input type="radio" name="nacionalidad" value="Otra" <?php if ($nacionalidad == "Otra")
                echo "checked"; ?>>
            Otra
        </p>

        <p>
            <label>Idiomas (selecciona al menos uno):</label><br>
            <input type="checkbox" name="idiomas[]" value="Español" <?php if (in_array("Español", $idiomas))
                echo "checked"; ?>> Español<br>
            <input type="checkbox" name="idiomas[]" value="Inglés" <?php if (in_array("Inglés", $idiomas))
                echo "checked"; ?>> Inglés<br>
            <input type="checkbox" name="idiomas[]" value="Francés" <?php if (in_array("Francés", $idiomas))
                echo "checked"; ?>> Francés<br>
            <input type="checkbox" name="idiomas[]" value="Alemán" <?php if (in_array("Alemán", $idiomas))
                echo "checked"; ?>> Alemán<br>
            <input type="checkbox" name="idiomas[]" value="Italiano" <?php if (in_array("Italiano", $idiomas))
                echo "checked"; ?>> Italiano<br>
        </p>

        <p>
            <label>Email:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </p>

        <p>
            <label>Foto (jpg, gif, png, máx 50KB):</label><br>
            <?php
            if (!empty($fotoAnterior)) {
                echo "<p><img src='$fotoAnterior' alt='Foto' width='200'></p>";
            }
            ?>
            <input type="file" name="foto"><br>
            <input type="hidden" name="fotoAnterior" value="<?php echo htmlspecialchars($fotoAnterior); ?>">
        </p>

        <p>
            <button type="submit" name="Validar">Validar</button>
            <button type="submit" name="Enviar">Enviar</button>
            <button type="reset" name="Limpiar">Limpiar</button>
        </p>
    </form>

</body>

</html>