<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de registro 4</title>
</head>
<body>
    <h1>Álvaro Escartí - Formulario de registro 4</h1>
    
    <form action="" method="get">
        <fieldset>
            <!-- Leyenda del recuadro -->
            <legend>Datos Personales</legend>
            
            <!-- Nombre -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" maxlength="50" placeholder="Escriba su Nombre" required><br><br>
            
            <!-- Apellidos -->
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" maxlength="200" placeholder="Escriba su Apellidos" required><br><br>
            
            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" maxlength="250" placeholder="usuario@empresa.com" required><br><br>
            
            <!-- Usuario -->
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" id="usuario" name="usuario" maxlength="5" placeholder="Escriba su nombre de usuario" required><br><br>
            
            <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" maxlength="15" placeholder="Escriba su password" required><br><br>
            
            <!-- Sexo -->
            <label>Sexo:</label>
            <input type="radio" id="hombre" name="sexo" value="hombre" checked>
            <label for="hombre">Hombre</label>
            <input type="radio" id="mujer" name="sexo" value="mujer">
            <label for="mujer">Mujer</label><br><br>
        </fieldset>

        <!-- Bloque Datos de contacto -->
        <fieldset>
            <legend>Datos de contacto</legend>
            
            <!-- Provincia -->
            <label for="provincia">Provincia:</label>
            <select id="provincia" name="provincia">
                <option value="Alicante">Alicante</option>
                <option value="Castellón">Castellón</option>
                <option value="Valencia">Valencia</option>
            </select><br><br>
            
            <!-- Horario de contacto -->
            <label for="horario">Horario de contacto:</label>
            <select id="horario" name="horario[]" multiple size="3">
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
        </fieldset>

        <!-- Bloque Datos de la incidencia -->
        <fieldset>
            <legend>Datos de la incidencia</legend>
            
            <!-- Tipo de incidencia -->
            <label for="tipo">Tipo de incidencia:</label>
            <select id="tipo" name="tipo">
                <option value="Teléfono Fijo">Teléfono Fijo</option>
                <option value="Teléfono Móvil">Teléfono Móvil</option>
                <option value="Internet">Internet</option>
                <option value="Televisión">Televisión</option>
            </select><br><br>
            
            <!-- Descripción de la incidencia -->
            <label for="descripcion">Descripción de la incidencia:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" cols="40" placeholder="Describa la incidencia..."></textarea><br><br>
        </fieldset>

        <!-- Botones -->
        <br>
        <input type="reset" value="Limpiar">
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        echo "<h2>Datos recibidos:</h2>";
        echo "<strong>Nombre:</strong> " . htmlspecialchars($_GET["nombre"]) . "<br>";
        echo "<strong>Apellidos:</strong> " . htmlspecialchars($_GET["apellidos"]) . "<br>";
        echo "<strong>Email:</strong> " . htmlspecialchars($_GET["email"]) . "<br>";
        echo "<strong>Usuario:</strong> " . htmlspecialchars($_GET["usuario"]) . "<br>";
        echo "<strong>Password:</strong> " . htmlspecialchars($_GET["password"]) . "<br>";
        echo "<strong>Sexo:</strong> " . htmlspecialchars($_GET["sexo"]) . "<br>";
        echo "<strong>Provincia:</strong> " . htmlspecialchars($_GET["provincia"]) . "<br>";
        
        if (!empty($_GET["horario"])) {
            echo "<strong>Horario de contacto:</strong> " . implode(", ", $_GET["horario"]) . "<br>";
        }
        
        if (!empty($_GET["conocido"])) {
            echo "<strong>¿Cómo nos ha conocido?:</strong> " . implode(", ", $_GET["conocido"]) . "<br>";
        }
        
        echo "<strong>Tipo de incidencia:</strong> " . htmlspecialchars($_GET["tipo"]) . "<br>";
        echo "<strong>Descripción de la incidencia:</strong> " . htmlspecialchars($_GET["descripcion"]) . "<br>";
    }
    ?>
</body>
</html>
