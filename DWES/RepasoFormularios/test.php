<?php

/**
 * @Author: Álvaro Escartí
 */


function comprobarNombre($nombre) {
    if (empty($nombre)) {
        return "El nombre no puede estar en vacío";
    }
}

function comprobarEmail($email){
    if (empty($email)) {
        return "El email no puede ser vacio";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El email no es válido";
    }

}

function mostrarErrores($errores) {
    echo "<ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}



$errores = [];
$nombre = $_POST['nombre'] ?? null;
$email = $_POST['correo'] ?? null;

echo "Fu";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "YUUUUUU";

    if (isset($_POST['Enviar'])) {
        $errores[] = comprobarNombre($nombre);
        $errores[] = comprobarEmail($email);
    }

}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Test</title>
</head>
<body>
    
    <?php mostrarErrores($errores) ?>
<form action="test.php" method="POST">
    <p>
    <label>Nombre completo: </label>
    <input type="text" name="nombre">
    </p>

    <p>
    <label> Correo </label>
    <input type="text" name="correo">
    </p>

    <button type="submit" name="Enviar">Enviar</button>
</form>
</body>
</html>