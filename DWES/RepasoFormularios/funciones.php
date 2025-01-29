<?php
/**
 * @Author: Álvaro Escartí
 */
function comprobarNombre($nombre){
    if (empty($nombre)) {
        return "El nombre no puede estar vacío";
    }
    // Comprobar que el nombre solo contiene letras
    if (!ctype_alpha(str_replace(' ', '', $nombre))) {
        return "El nombre solo puede contener letras y espacios";
    }
    // devuelvo vacío si no hay errores
    return null;
}


function comprobarEmail($email){
    if (empty($email)) {
        return "El email no puede estar vacío";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El email no es válido";
    }
    return null;
}
function comprobarSituacion($situacion){
    if (empty($situacion)) {
        return "Debes seleccionar al menos una opción en 'Situación'";
    }
    return null;
}
function comprobarIdioma($idiomas){
    if (empty($idiomas)) {
        return "Debes elegir al menos un idioma";
    }
    return null;
}
function mostrarErrores($errores){
    // Si hay errores, los mostramos
    if (count($errores) > 0) {
        echo "<ul class='error'>";
        foreach($errores as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul>";
    } elseif (isset($_POST['validar']) && count($errores) == 0) {
        // Si validamos y no hay errores, mostramos un mensaje de éxito
        echo "<p class='ok'>Formulario validado correctamente.</p>";
    }
}

?>