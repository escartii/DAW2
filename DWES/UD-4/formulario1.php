<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de registro</title>
</head>
<body>
    <h1>Álvaro Escartí - Formulario de registro</h1>
    <form action="" method="GET">
        <!-- Campo de nombre -->
        <label for="nombre">Nombre (máximo 50 caracteres):</label>
        <input type="text" id="nombre" name="nombre" maxlength="50" required>
        <br><br>

        <!-- Campo de apellidos -->
        <label for="apellidos">Apellidos (máximo 200 caracteres):</label>
        <input type="text" id="apellidos" name="apellidos" maxlength="200" required>
        <br><br>

        <!-- Selección de sexo -->
        <label>Sexo:</label>
        <input type="radio" id="hombre" name="sexo" value="Hombre" required>
        <label for="hombre">Hombre</label>
        <input type="radio" id="mujer" name="sexo" value="Mujer" required>
        <label for="mujer">Mujer</label>
        <br><br>

        <!-- Correo electrónico -->
        <label for="email">Correo electrónico (máximo 250 caracteres):</label>
        <input type="email" id="email" name="email" maxlength="250" required>
        <br><br>

        <!-- Selección de provincia -->
        <label for="provincia">Provincia:</label>
        <select id="provincia" name="provincia" required>
            <option value="Alicante">Alicante</option>
            <option value="Castellón">Castellón</option>
            <option value="Valencia">Valencia</option>
        </select>
        <br><br>

        <!-- Casillas de verificación -->
        <input type="checkbox" id="novedades" name="novedades" checked>
        <label for="novedades">Deseo recibir información sobre novedades y ofertas.</label>
        <br><br>

        <input type="checkbox" id="condiciones" name="condiciones" required>
        <label for="condiciones">Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de datos.</label>
        <br><br>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>

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
            echo "<li><strong>$campo:</strong> $valor</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
