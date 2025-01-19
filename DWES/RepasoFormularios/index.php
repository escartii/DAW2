<?php

$carpeta = "uploads/";
if(!is_dir($carpeta)){
    mkdir($carpeta, 0777, true);
}

$nombre = "";
$pass = "";
$nivel = "";
$nacionalidad = "";
$email = "";
$idiomas = [];
$fotoAnterior = "";

$maxSize = 50 * 1024;
$errores = [];

$accion = "";
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
}

if ($accion == "Validar" || $accion == "Enviar") {
    
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

    // Comprobamos si se ha subido foto nueva o no.
    $nuevaFotoSubida = false;

    if (empty($fotoAnterior)) {
        // No había foto validada antes, por tanto es obligatorio subir una ahora
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] != 0) {
            $errores[] = "Debes subir una foto";
        } else {
            $nuevaFotoSubida = true;
        }
    } else {
        // Ya teníamos una foto. Ver si ahora suben otra
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $nuevaFotoSubida = true;
        }
    }

    // si han subido una foto
    if ($nuevaFotoSubida) {
        // compruebo el tamaño de la imagen
        if ($_FILES['foto']['size'] > $maxSize) {
            $errores[] = "La foto excede el tamaño máximo (50KB)";
        }

        // compruebo la ext de la imagen
        $nombreOriginal = $_FILES['foto']['name'];
        $info = pathinfo($nombreOriginal);
        $ext = "";
        if (isset($info['extension'])) {
            $ext = strtolower($info['extension']);
        }
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png") {
            $errores[] = "La extensión de la imagen no es válida (usa jpg, gif o png)";
        }
    }

    if (count($errores) == 0 && $nuevaFotoSubida) {
        $nuevoNombre = uniqid("img_") . "." . $ext;
        $rutaDestino = $carpeta . $nuevoNombre;
        
        $subidaOk = move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
        if ($subidaOk) {
            $fotoAnterior = $rutaDestino;
        } else {
            $errores[] = "Error al mover la foto al directorio de destino";
        }
    }

    if ($accion == "Validar") {
    } else if ($accion == "Enviar") {
        if (count($errores) == 0) {
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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario con Validaciones</title>
    <style>
        .error { color: red; }
        .ok { color: green; }
    </style>
</head>
<body>

<h1>Formulario de Registro</h1>

<?php
// si hay algun error los pinto
if (count($errores) > 0) {
    echo "<ul class='error'>";
    foreach($errores as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul>";
} else {
    // si hemos pulsado validar y todo está bien, mostramos mensaje verde y la foto
    if ($accion == "Validar" && $accion != "" && count($errores) == 0) {
        echo "<p class='ok'>Formulario validado correctamente.</p>";
        if (!empty($fotoAnterior)) {
            echo "<p><img src='$fotoAnterior' alt='Foto' width='200'></p>";
        }
    }
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
            <option <?php if($nivel=="Sin estudios") echo "selected"; ?>>Sin estudios</option>
            <option <?php if($nivel=="Educación Secundaria Obligatoria") echo "selected"; ?>>
                Educación Secundaria Obligatoria
            </option>
            <option <?php if($nivel=="Bachillerato") echo "selected"; ?>>Bachillerato</option>
            <option <?php if($nivel=="Formación Profesional") echo "selected"; ?>>Formación Profesional</option>
            <option <?php if($nivel=="Estudios Universitarios") echo "selected"; ?>>Estudios Universitarios</option>
        </select>
    </p>

    <p>
        <label>Nacionalidad:</label><br>
        <input type="radio" name="nacionalidad" value="Española" 
               <?php if($nacionalidad=="Española") echo "checked"; ?>> Española
        <input type="radio" name="nacionalidad" value="Otra"
               <?php if($nacionalidad=="Otra") echo "checked"; ?>> Otra
    </p>

    <p>
        <label>Idiomas (selecciona al menos uno):</label><br>
        <?php
        $listaIdiomas = ["Español","Inglés","Francés","Alemán","Italiano"];
        foreach($listaIdiomas as $idi){
            $checked = in_array($idi, $idiomas) ? "checked" : "";
            echo "<input type='checkbox' name='idiomas[]' value='$idi' $checked> $idi<br>";
        }
        ?>
    </p>

    <p>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    </p>

    <p>
        <label>Foto (jpg, gif, png, máx 50KB):</label><br>
        <input type="file" name="foto">
        <input type="hidden" name="fotoAnterior" value="<?php echo htmlspecialchars($fotoAnterior); ?>">
    </p>

    <p>
        <button type="submit" name="accion" value="Validar">Validar</button>
        <button type="submit" name="accion" value="Enviar">Enviar</button>
    </p>
</form>

</body>
</html>
