<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de registro</title>
</head>
<body>

<h1 style="text-align:center;">Álvaro Escartí - Formulario de registro</h1>

<form action="" method="GET">
    
    <!-- Nombre -->
    <label for="nombre">Nombre (máx 50 caracteres):</label>
    <input type="text" id="nombre" name="nombre" maxlength="50" required>
    <br><br>
    
    <!-- Apellidos -->
    <label for="apellidos">Apellidos (máx 200 caracteres):</label>
    <input type="text" id="apellidos" name="apellidos" maxlength="200" required>
    <br><br>
    
    <!-- Correo electrónico -->
    <label for="email">Correo electrónico (máx 250 caracteres):</label>
    <input type="email" id="email" name="email" maxlength="250" required>
    <br><br>
    
    <!-- Usuario -->
    <label for="usuario">Usuario (máx 5 caracteres):</label>
    <input type="text" id="usuario" name="usuario" maxlength="5" required>
    <br><br>
    
    <!-- Password -->
    <label for="password">Password (máx 15 caracteres):</label>
    <input type="password" id="password" name="password" maxlength="15" required>
    <br><br>
    
    <!-- Sexo -->
    <label>Sexo:</label>
    <br>
    <input type="radio" id="hombre" name="sexo" value="hombre" required>
    <label for="hombre">Hombre</label>
    <input type="radio" id="mujer" name="sexo" value="mujer" required>
    <label for="mujer">Mujer</label>
    <br><br>
    
    <!-- Provincia -->
    <label for="provincia">Provincia:</label>
    <br>
    <select id="provincia" name="provincia" required>
        <option value="Alicante">Alicante</option>
        <option value="Castellón">Castellón</option>
        <option value="Valencia">Valencia</option>
    </select>
    <br><br>
    
    <!-- Situación -->
    <label for="situacion">Situación:</label>
    <br>
    <select id="situacion" name="situacion[]" size="2" multiple required>
        <option value="Estudiando">Estudiando</option>
        <option value="Trabajando">Trabajando</option>
        <option value="Buscando empleo">Buscando empleo</option>
        <option value="Otro">Otro</option>
    </select>
    <br><br>
    
    <!-- Comentario -->
    <label for="comentario">Comentario:</label>
    <textarea id="comentario" name="comentario" rows="6" cols="60"></textarea>
    <br><br>
    
    <!-- Novedades -->
    <input type="checkbox" id="novedades" name="novedades" checked>
    <label for="novedades">Deseo recibir información sobre novedades y ofertas</label>
    <br><br>
    
    <!-- Aceptación de condiciones -->
    <input type="checkbox" id="condiciones" name="condiciones" required>
    <label for="condiciones">Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de datos</label>
    <br><br>
    
    <!-- Botones -->
    <input type="submit" value="Enviar">
    <input type="reset" value="Limpiar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<h2>Datos recibidos:</h2>";
    echo "Nombre: " . htmlspecialchars($_GET['nombre']) . "<br>";
    echo "Apellidos: " . htmlspecialchars($_GET['apellidos']) . "<br>";
    echo "Correo electrónico: " . htmlspecialchars($_GET['email']) . "<br>";
    echo "Usuario: " . htmlspecialchars($_GET['usuario']) . "<br>";
    echo "Sexo: " . htmlspecialchars($_GET['sexo']) . "<br>";
    echo "Provincia: " . htmlspecialchars($_GET['provincia']) . "<br>";
    echo "Situación: " . implode(", ", $_GET['situacion']) . "<br>";
    echo "Comentario: " . htmlspecialchars($_GET['comentario']) . "<br>";
    
    if (isset($_GET['novedades'])) {
        echo "Novedades: Sí<br>";
    } else {
        echo "Novedades: No<br>";
    }
    
    if (isset($_GET['condiciones'])) {
        echo "Condiciones aceptadas<br>";
    } else {
        echo "Condiciones no aceptadas<br>";
    }
}
?>

</body>
</html>
