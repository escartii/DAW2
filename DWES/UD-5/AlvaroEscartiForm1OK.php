<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Formulario</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Recogemos los datos del formulario en un array
        $datosFormulario = array(
            'Nombre' => $_GET['nombre'],
            'Apellidos' => $_GET['apellidos'],
            'Sexo' => $_GET['sexo'],
            'Correo electrónico' => $_GET['email'],
            'Provincia' => $_GET['provincia'],
            'Deseo recibir novedades' => isset($_GET['novedades']) ? 'Sí' : 'No',
            'Acepta condiciones' => isset($_GET['condiciones']) ? 'Sí' : 'No'
        );

        // Mostramos los datos por pantalla
        echo "<h2>Datos enviados:</h2>";
        echo "<ul>";
        foreach ($datosFormulario as $campo => $valor) {
            // Mostramos el campo en cursiva y el valor en negrita
            echo "<li><em>$campo:</em> <strong>$valor</strong></li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
