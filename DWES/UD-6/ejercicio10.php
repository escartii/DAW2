<?php

/**
 * @Author: Álvaro Escartí Lamolda
 */

// Recuperar la preferencia anterior antes de sobrescribir
$publicidad_anterior = isset($_COOKIE['preferencia_publicidad']) ? $_COOKIE['preferencia_publicidad'] : 'Ninguna';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $email = $_POST['email'];
    $confirm_email = $_POST['confirm_email'];
    $publicidad = isset($_POST['publicidad']) ? "Sí" : "No";

    // Verificar si los correos coinciden
    if ($email === $confirm_email) {
        // Guardar la preferencia de publicidad en una cookie
        setcookie("preferencia_publicidad", $publicidad, time() + 3600); // Cookie válida por 1 hora

        // Mostrar los datos enviados
        echo "<h1>Información Enviada</h1>";
        echo "<p>Email: $email</p>";
        echo "<p>Publicidad: $publicidad</p>";

        // Mostrar la preferencia anterior
        echo "<h2>Preferencia anterior:</h2>";
        echo "<p>Publicidad: $publicidad_anterior</p>";
    } else {
        echo "<h1>Error</h1>";
        echo "<p>Los correos electrónicos no coinciden. Por favor, regrese al formulario y corríjalo.</p>";
        echo '<a href="formulario.php">Volver al formulario</a>';
    }
} else {
    echo "<h1>Error</h1>";
    echo "<p>Acceso no válido. Por favor, complete el formulario primero.</p>";
    echo '<a href="formulario.php">Volver al formulario</a>';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Álvaro Escartí Lamolda</title>
</head>

<body>
    <h1>Formulario de Confirmación de Email</h1>

    <form action="" method="post">
        <label for="email">Dirección de correo electrónico:</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        
        <label for="confirm_email">Confirme su correo electrónico:</label>
        <input type="email" name="confirm_email" id="confirm_email" required>
        <br><br>
        
        <label>
            <input type="checkbox" name="publicidad" value="1">
            Acepto recibir publicidad
        </label>
        <br><br>
        
        <button type="submit">Enviar</button>
        <button type="reset">Borrar</button>
    </form>
</body>

</html>