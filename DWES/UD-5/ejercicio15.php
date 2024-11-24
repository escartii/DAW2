<!-- Formulario3.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de registro 3</title>
</head>
<body>
    <h1>Álvaro Escartí - Formulario de registro 3</h1>
    
    <form action="AlvaroEscartiFormOK3.php" method="POST">
        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" maxlength="50" required><br><br>
        
        <!-- Apellidos -->
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" maxlength="200" required><br><br>
        
        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" maxlength="250" required><br><br>
        
        <!-- Usuario -->
        <label for="usuario">Nombre de usuario:</label>
        <input type="text" id="usuario" name="usuario" maxlength="5" required><br><br>
        
        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" maxlength="15" required><br><br>
        
        <!-- Sexo -->
        <label>Sexo:</label>
        <input type="radio" id="hombre" name="sexo" value="hombre" required>
        <label for="hombre">Hombre</label>
        <input type="radio" id="mujer" name="sexo" value="mujer">
        <label for="mujer">Mujer</label><br><br>
        
        <!-- Provincia -->
        <label for="provincia">Provincia:</label>
        <select id="provincia" name="provincia">
            <option value="Alicante">Alicante</option>
            <option value="Castellón">Castellón</option>
            <option value="Valencia">Valencia</option>
        </select><br><br>
        
        <!-- Horario de contacto -->
        <label for="horario">Horario de contacto:</label>
        <select id="horario" name="horario[]" multiple size="2">
            <option value="De 8 a 14 horas">De 8 a 14 horas</option>
            <option value="De 14 a 18 horas">De 14 a 18 horas</option>
            <option value="De 18 a 21 horas">De 18 a 21 horas</option>
        </select><br><br>
        
        <!-- Cómo nos ha conocido -->
        <label>¿Cómo nos ha conocido?</label><br>
        <input type="checkbox" id="amigo" name="conocido[]" value="Un amigo">
        <label for="amigo">Un amigo</label><br>
        <input type="checkbox" id="web" name="conocido[]" value="Web">
        <label for="web">Web</label><br>
        <input type="checkbox" id="prensa" name="conocido[]" value="Prensa">
        <label for="prensa">Prensa</label><br>
        <input type="checkbox" id="otros" name="conocido[]" value="Otros">
        <label for="otros">Otros</label><br><br>
        
        <!-- Comentario -->
        <label for="comentario">Comentario:</label><br>
        <textarea id="comentario" name="comentario" rows="6" cols="60"></textarea><br><br>
        
        <!-- Deseo recibir información -->
        <input type="checkbox" id="ofertas" name="ofertas" value="1" checked>
        <label for="ofertas">Deseo recibir información sobre novedades y ofertas</label><br><br>
        
        <!-- Aceptar condiciones -->
        <input type="checkbox" id="condiciones" name="condiciones" value="1" required>
        <label for="condiciones">Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de datos</label><br><br>
        
        <!-- Botones -->
        <input type="reset" value="Limpiar">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
