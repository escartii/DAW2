<?php
// validaciones.php

function validarNombre($nombre) {
    if (empty($nombre)) {
        return "El nombre completo es obligatorio";
    } else if (!ctype_alpha(str_replace(' ', '', $nombre))) {
        return "El nombre completo no puede contener números";
    }
    return null;
}

function validarPass($pass) {
    if (empty($pass) || strlen($pass) < 6) {
        return "La contraseña debe tener al menos 6 caracteres";
    }
    return null;
}

function validarNivel($nivel) {
    $nivelesValidos = [
        "Sin estudios",
        "Educación Secundaria Obligatoria",
        "Bachillerato",
        "Formación Profesional",
        "Estudios Universitarios"
    ];
    if (empty($nivel) || !in_array($nivel, $nivelesValidos)) {
        return "Selecciona un nivel de estudios válido";
    }
    return null;
}

function validarNacionalidad($nacionalidad) {
    if (empty($nacionalidad) || ($nacionalidad != "Española" && $nacionalidad != "Otra")) {
        return "La nacionalidad debe ser 'Española' u 'Otra'";
    }
    return null;
}

function validarEmail($email) {
    if (empty($email)) {
        return "El email es obligatorio";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El formato del email no es válido";
    }
    return null;
}

function validarIdiomas($idiomas) {
    if (empty($idiomas)) {
        return "Debes seleccionar al menos un idioma";
    }
    return null;
}

function validarFoto($foto, $maxSize) {
    if ($foto['error'] != 0) {
        return "Debes subir una foto";
    }

    if ($foto['size'] > $maxSize) {
        return "La foto excede el tamaño máximo (2KB)";
    }

    $nombreOriginal = $foto['name'];
    $info = pathinfo($nombreOriginal);
    $ext = "";
    if (isset($info['extension'])) {
        $ext = strtolower($info['extension']);
    }
    if ($ext != "jpg" && $ext != "gif" && $ext != "png") {
        return "La extensión de la imagen no es válida (usa jpg, gif o png)";
    }

    return null;
}
?>