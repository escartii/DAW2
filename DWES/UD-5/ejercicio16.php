<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de registro POST</title>
</head>
<body>
    <h1>Álvaro Escartí - Formulario de registro POST</h1>
    
    <form action="AlvaroEscartiForm1OK.php" method="post">
        <fieldset>
            <legend>Datos Personales</legend>
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" maxlength="50" placeholder="Escriba su Nombre" required><br><br>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" maxlength="200" placeholder="Escriba sus Apellidos" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" maxlength="250" placeholder="usuario@empresa.com" required><br><br>
            
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" id="usuario" name="usuario" maxlength="5" placeholder="Escriba su nombre de usuario" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" maxlength="15" placeholder="Escriba su password" required><br><br>
            
            <label>Sexo:</label>
            <input type="radio" id="hombre" name="sexo" value="hombre" checked>
            <label for="hombre">Hombre</label>
            <input type="radio" id="mujer" name="sexo" value="mujer">
            <label for="mujer">Mujer</label><br><br>
        </fieldset>

        <fieldset>
            <legend>Datos de contacto</legend>
            
            <label for="provincia">Provincia:</label>
            <select id="provincia" name="provincia">
                <option value="Alicante">Alicante</option>
                <option value="Castellón">Castellón</option>
                <option value="Valencia">Valencia</option>
            </select><br><br>
            
            <label for="horario">Horario de contacto:</label>
            <select id="horario" name="horario[]" multiple size="3">
                <option value="De 8 a 14 horas">De 8 a 14 horas</option>
                <option value="De 14 a 18 horas">De 14 a 18 horas</option>
                <option value="De 18 a 21 horas">De 18 a 21 horas</option>
            </select><br><br>
            
            <label>¿Cómo nos ha conocido?</label><br>
            <input type="checkbox" id="amigo" name="conocido[]" value="Un amigo">
            <label for="amigo">Un amigo</label><br>
            <input type="checkbox" id="web" name="conocido[]" value="Web">
            <label for="web">Web</label><br>
            <input type="checkbox" id="prensa" name="conocido[]" value="Prensa">
            <label for="prensa">Prensa</label><br>
            <input type="checkbox" id="otros" name="conocido[]" value="Otros">
            <label for="otros">Otros</label><br><br>
        </fieldset>

        <fieldset>
            <legend>Datos de la incidencia</legend>
            
            <label for="tipo">Tipo de incidencia:</label>
            <select id="tipo" name="tipo">
                <option value="Teléfono Fijo">Teléfono Fijo</option>
                <option value="Teléfono Móvil">Teléfono Móvil</option>
                <option value="Internet">Internet</option>
                <option value="Televisión">Televisión</option>
            </select><br><br>
            
            <label for="descripcion">Descripción de la incidencia:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" cols="40" placeholder="Describa la incidencia..."></textarea><br><br>
        </fieldset>

        <br>
        <input type="reset" value="Limpiar">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>