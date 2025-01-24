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

// variables
$errores = [];
$nombre = $_POST['nombre'] ?? null;
$email = $_POST['correo'] ?? null;
$situacion = $_POST['situacion'] ?? [];
$idiomas = $_POST['idiomas'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['validar'])) {
        $errorNombre = comprobarNombre($nombre);
        if ($errorNombre) $errores[] = $errorNombre;

        $errorEmail = comprobarEmail($email);
        if ($errorEmail) $errores[] = $errorEmail;

        $errorSituacion = comprobarSituacion($situacion);
        if ($errorSituacion) $errores[] = $errorSituacion;

        $errorIdioma = comprobarIdioma($idiomas);
        if ($errorIdioma) $errores[] = $errorIdioma;
    }

    if (isset($_POST['limpiar'])) {
        $nombre = null;
        $email = null;
        $situacion = [];
        $idiomas = [];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Test</title>
    <style>
        .error { color: red; }
        .ok { color: green; }
    </style>
</head>

<body>

    <?php mostrarErrores($errores) ?>
    <form action="funciones.php" method="POST">
        <p>
            <label>Nombre completo: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre ?? ''); ?>">
        </p>

        <p>
            <label> Correo </label>
            <input type="text" name="correo" value="<?php echo htmlspecialchars($email ?? ''); ?>">
        </p>

        <p>
            <label> Situación: </label>
            <select id="situacion" name="situacion[]" size="3" multiple>
                <option value="estudiante" <?php if (in_array("estudiante", $situacion)) echo "selected"; ?>>Estudiante</option>
                <option value="trabajador" <?php if (in_array("trabajador", $situacion)) echo "selected"; ?>>Trabajador</option>
                <option value="desempleado" <?php if (in_array("desempleado", $situacion)) echo "selected"; ?>>Desempleado</option>
            </select>
        </p>

        <p>
            <label>Idiomas (selecciona al menos uno):</label><br>
            <input type="checkbox" name="idiomas[]" value="Español" <?php if (in_array("Español", $idiomas)) echo "checked"; ?>> Español<br>
            <input type="checkbox" name="idiomas[]" value="Inglés" <?php if (in_array("Inglés", $idiomas)) echo "checked"; ?>> Inglés<br>
            <input type="checkbox" name="idiomas[]" value="Francés" <?php if (in_array("Francés", $idiomas)) echo "checked"; ?>> Francés<br>
            <input type="checkbox" name="idiomas[]" value="Alemán" <?php if (in_array("Alemán", $idiomas)) echo "checked"; ?>> Alemán<br>
            <input type="checkbox" name="idiomas[]" value="Italiano" <?php if (in_array("Italiano", $idiomas)) echo "checked"; ?>> Italiano<br>
        </p>

        <button type="submit" name="validar">Validar</button>
        <button type="submit" name="enviar">Enviar</button>
        <button type="submit" name="limpiar">Limpiar</button>
    </form>
</body>

</html>