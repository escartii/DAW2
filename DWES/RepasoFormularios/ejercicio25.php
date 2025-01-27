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
        // Si es un array, lo convertimos a una cadena separada por comas
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
