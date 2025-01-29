<?php

$nombre = null;
$usuario = null;
$pass = null;
$poblacion = null;
$eleccion = null;
$elementosAfectados = [];
$necesidades = [];
$email = null;
$fotoAnterior = "";
$maxSize = 100 * 1024;
$errores = [];
$acepta = null;

$carpeta = "img/";

// Verificamos que se haya enviado el formulario por POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Procesar los datos del formulario
    if (isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']);
    }

    if (isset($_POST['usuario'])) {
        $usuario = trim($_POST['usuario']);
    }
    if (isset($_POST['pass'])) {
        $pass = trim($_POST['pass']);
    }
    if (isset($_POST['poblacion'])) {
        $poblacion = $_POST['poblacion'];
    }
    if (isset($_POST['eleccion'])) {
        $eleccion = $_POST['eleccion'];
    }
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    }

    if (isset($_POST['elementosAfectados'])) {
        $elementosAfectados = $_POST['elementosAfectados'];
    } else {
        $elementosAfectados = [];
    }

    if (isset($_POST['acepta'])) {
        $acepta = $_POST['acepta'];
    }

    if (isset($_POST['necesidades'])) {
        $necesidades = $_POST['necesidades'];
    } else {
        $necesidades = [];
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

    if (empty($usuario)) {
        $errores[] = "El usuario es obligatorio";
    }

    if (empty($pass) || strlen($pass) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    } else if (!ctype_alnum($pass)) {
        $errores[] = "La contraseña debe ser exclusivamente letras y numeros";
    }

    $poblacionesValidos = [
        "Sin estudios",
        "Educación Secundaria Obligatoria",
        "Bachillerato",
        "Formación Profesional",
        "Estudios Universitarios"
    ];
    if (empty($poblacion)) {
        $errores[] = "Selecciona una población válida";
    }

    if (empty($elementosAfectados)) {
        $errores[] = "Selecciona un elemento afectado...";
    }

    if (empty($necesidades)) {
        $errores[] = "Selecciona al menos una necesidad";
    }

    if (empty($eleccion) || ($eleccion != "Particular" && $eleccion != "Empresa")) {
        $errores[] = "La eleccion debe ser 'Particular' u 'Empresa'";
    }

    if (empty($email)) {
        $errores[] = "El email es obligatorio";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del email no es válido";
    }

    if (empty($acepta)) {
        $errores[] = "Tienes que aceptar los términos y condiciones";
    }

    if (empty($fotoAnterior)) {
        // Si no había foto antes, es obligatorio subir una ahora
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
            $errores[] = "Debes subir una foto";
        } else {
            $nuevaFotoSubida = true;
        }
    } else {
        // Si había foto antes, verificamos si suben Empresa
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $nuevaFotoSubida = true;
        }
    }

    /// Si han subido una foto, validamos el tamaño y la extensión
    if ($nuevaFotoSubida) {
        if ($_FILES['foto']['size'] > $maxSize) {
            $errores[] = "La foto excede el tamaño máximo (100KB)";
        }

        $nombreOriginal = $_FILES['foto']['name'];
        $info = pathinfo($nombreOriginal);
        $ext = "";
        if (isset($info['extension'])) {
            $ext = strtolower($info['extension']);
        }
        if ($ext != "png") {
            $errores[] = "La extensión de la imagen no es válida (usa png)";
        }
    }

    // Si no hay errores y se subió una foto, la guardamos
    if (count($errores) == 0 && $nuevaFotoSubida) {
        // Reemplazamos espacios por guiones bajos en el nombre
        $nombreSanitizado = str_replace(' ', '_', $nombre);
        
        // Construimos el nuevo nombre usando el nombre del usuario y uniqid
        $nuevoNombre = $nombreSanitizado . '_' . uniqid() . "." . $ext;
        
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
        $elementosAfectadosParseado = implode(",", $elementosAfectados);
        $necesidadesParseado = implode(",", $necesidades);
        $url = "AlvaroEscarti_ok.php?";
        $url .= "nombre=" . urlencode($nombre);
        $url .= "&pass=" . urlencode($pass);
        $url .= "&usuario=" . urlencode($usuario);
        $url .= "&poblacion=" . urlencode($poblacion);
        $url .= "&email=" . urlencode($email);
        $url .= "&elementosAfectados=" . urlencode($elementosAfectadosParseado);
        $url .= "&necesidades=" . urlencode($necesidadesParseado);
        $url .= "&foto=" . urlencode($fotoAnterior);

        header("Location: $url");
        exit;
    }

    if (isset($_POST['Limpiar']) && count($errores) == 0) {
        $nombre = null;
        $usuario = null;
        $pass = null;
        $poblacion = null;
        $eleccion = null;
        $elementosAfectados = [];
        $necesidades = [];
        $email = null;
        $fotoAnterior = null;
        $maxSize = 100 * 1024;
        $errores = [];
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

    <h1><strong>Necesidades POST-DANA</strong></h1>

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

    <form action="AlvaroEscarti.php" method="post" enctype="multipart/form-data">
        <p>
            <label>Nombre completo:</label><br>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        </p>

        <p>
            <label>Email:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </p>

        <p>
            <label>Usuario:</label><br>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
        </p>

        <p>
            <label>Contraseña (mín. 6 car.):</label><br>
            <input type="password" name="pass" value="<?php echo htmlspecialchars($pass); ?>">
        </p>

        <p>
            <label>eleccion:</label><br>
            <input type="radio" name="eleccion" value="Particular" <?php if ($eleccion == "Particular")
                echo "checked"; ?>> Particular
            <input type="radio" name="eleccion" value="Empresa" <?php if ($eleccion == "Empresa")
                echo "checked"; ?>>
            Empresa
        </p>

        <p>
            <label>Población afectada: </label><br>
            <select name="poblacion">
                <option value="">Seleccione...</option>
                <option <?php if ($poblacion == "Aldaia")
                    echo "selected"; ?>>Aldaia</option>
                <option <?php if ($poblacion == "Catarroja")
                    echo "selected"; ?>>Catarroja</option>
                <option <?php if ($poblacion == "Paiporta")
                    echo "selected"; ?>>Paiporta</option>
                <option <?php if ($poblacion == "Picaña")
                    echo "selected"; ?>>Picaña</option>
                <option <?php if ($poblacion == "Sedaví")
                    echo "selected"; ?>>Sedaví
                </option>
            </select>
        </p>

        <p>
            <label> Elementos afectados: </label><br>
            <select multiple name="elementosAfectados[]">
                <option value="Casa" <?php echo in_array("Casa", $elementosAfectados) ? "selected" : "" ?>>Casa</option>
                <option value="Bajo Comercial" <?php echo in_array("Bajo Comercial", $elementosAfectados) ? "selected" : "" ?>>
                    Bajo Comercial</option>
                <option value="Sotanos" <?php echo in_array("Sótanos Garaje", $elementosAfectados) ? "selected" : "" ?>>
                    Sótanos Garaje</option>
                <option value="Vehículo" <?php echo in_array("Vehículo", $elementosAfectados) ? "selected" : "" ?>>
                    Vehículo</option>
            </select><br><br>
        </p>

        <p>
            <label> ¿Qué necesidades tienes? </label><br>
            <select multiple name="necesidades[]">
                <option value="Extracción de lodo" <?php echo in_array("Extraccion de lodo", $necesidades) ? "selected" : "" ?>>Extracción de lodo</option>
                <option value="Limpieza" <?php echo in_array("Limpieza", $necesidades) ? "selected" : "" ?>>Limpieza
                </option>
                <option value="Desinfección y secado" <?php echo in_array("Desinfección y secado", $necesidades) ? "selected" : "" ?>>Desinfección y secado</option>
                <option value="Revisión de estuctura" <?php echo in_array("Revisión de estructura", $necesidades) ? "selected" : "" ?>>Revisión de esctructura</option>
                <option value="Tareas de reconstrucción" <?php echo in_array("Tareas de reconstrucción", $necesidades) ? "selected" : "" ?>>Tareas de reconstrucción</option>
                <option value="Excarcelación de coches" <?php echo in_array("Excarcelación de coches", $necesidades) ? "selected" : "" ?>>Excarcelación de coches</option>
            </select><br><br>
        </p>

        <input type="checkbox" name="acepta" <?php if ($acepta === 'on') echo 'checked'; ?>>
        <label for="acepta"> Acepto la LOPDGDD</label>

        <p>
            <label>Foto (png máx 100):</label><br>
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