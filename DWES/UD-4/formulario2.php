<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de Registro</title>
</head>
<body>
    <h1> Álvaro Escartí - Formulario de Registro </h1>
    <form action="">
        <label for="nombre" > Nombre (máximo 50 carácteres) : </label>
        <input type="text" name="nombre" maxlength="50" required>
        <br><br>

        <label for="apellidos"> Apellidos: </label>
        <input type="text" name="apellidos" maxlength="200" required>
        <br><br>
        
        <label for="correo"> Correo electrónico: </label>
        <input type="text" name="correo" maxlength="250" required>
        <br><br>

        <label for="usuario"> Nombre de usuario: </label>
        <input type="text" name="usuario" maxlength="5" required>
        <br><br>

        <label for="contraseña"> Introduce contraseña: </label>
        <input type="password" name="contraseña" minlength="15" required>
        <br><br>

        <!-- Selección de sexo -->
        <label>Sexo:</label>
        <input type="radio" id="hombre" name="sexo" value="Hombre" required>
        <label for="hombre">Hombre</label>
        <input type="radio" id="mujer" name="sexo" value="Mujer" required>
        <label for="mujer">Mujer</label>
        <br><br>

    </form>
</body>
</html>