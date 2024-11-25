<?php

/**
 * @Author: Álvaro Escartí
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $confirm_email = $_POST['confirm_email'];
    $publicidad = isset($_POST['publicidad']) ? "Sí" : "No";

    // Verificar si los correos coinciden
    if ($email === $confirm_email) {
        echo "<h1>Información Enviada</h1>";
        echo "<p>Email: $email</p>";
        echo "<p>Publicidad: $publicidad</p>";
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