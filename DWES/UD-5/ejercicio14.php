<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de Registro</title>
</head>
<body>

<h1 style="text-align:center;">Álvaro Escartí - Formulario de Registro</h1>

<!-- Mostrar mensajes de error o éxito -->
<?php
    // Incluir el archivo de procesamiento PHP
    // Asegúrate de que este archivo esté en el mismo directorio o ajusta la ruta según corresponda
    include 'AlvaroEscartiForm2OK.php';
?>

<form action="AlvaroEscartiForm2OK.php" method="POST">
    
    <!-- Nombre -->
    <label for="nombre">Nombre (máx 50 caracteres):</label>
    <input type="text" id="nombre" name="nombre" maxlength="50" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
    <br><br>
    
    <!-- Apellidos -->
    <label for="apellidos">Apellidos (máx 200 caracteres):</label>
    <input type="text" id="apellidos" name="apellidos" maxlength="200" value="<?php echo isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : ''; ?>">
    <br><br>
    
    <!-- Correo electrónico -->
    <label for="email">Correo electrónico (máx 250 caracteres):</label>
    <input type="email" id="email" name="email" maxlength="250" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    <br><br>
    
    <!-- Usuario -->
    <label for="usuario">Usuario (máx 5 caracteres):</label>
    <input type="text" id="usuario" name="usuario" maxlength="5" value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
    <br><br>
    
    <!-- Password -->
    <label for="password">Password (máx 15 caracteres):</label>
    <input type="password" id="password" name="password" maxlength="15">
    <br><br>
    
    <!-- Sexo -->
    <label>Sexo:</label>
    <br>
    <input type="radio" id="hombre" name="sexo" value="hombre" <?php echo (isset($_POST['sexo']) && $_POST['sexo'] === 'hombre') ? 'checked' : ''; ?>>
    <label for="hombre">Hombre</label>
    <input type="radio" id="mujer" name="sexo" value="mujer" <?php echo (isset($_POST['sexo']) && $_POST['sexo'] === 'mujer') ? 'checked' : ''; ?>>
    <label for="mujer">Mujer</label>
    <br><br>
    
    <!-- Provincia -->
    <label for="provincia">Provincia:</label>
    <br>
    <select id="provincia" name="provincia">
        <option value="">--Selecciona una provincia--</option>
        <option value="Alicante" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] === 'Alicante') ? 'selected' : ''; ?>>Alicante</option>
        <option value="Castellón" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] === 'Castellón') ? 'selected' : ''; ?>>Castellón</option>
        <option value="Valencia" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] === 'Valencia') ? 'selected' : ''; ?>>Valencia</option>
    </select>
    <br><br>
    
    <!-- Situación -->
    <label for="situacion">Situación:</label>
    <br>
    <select id="situacion" name="situacion[]" size="2" multiple>
        <?php
            $opcionesSituacion = ["Estudiando", "Trabajando", "Buscando empleo", "Otro"];
            foreach ($opcionesSituacion as $opcion) {
                $seleccionado = (isset($_POST['situacion']) && in_array($opcion, $_POST['situacion'])) ? 'selected' : '';
                echo "<option value=\"$opcion\" $seleccionado>$opcion</option>";
            }
        ?>
    </select>
    <br><br>
    
    <!-- Comentario -->
    <label for="comentario">Comentario:</label>
    <textarea id="comentario" name="comentario" rows="6" cols="60"><?php echo isset($_POST['comentario']) ? htmlspecialchars($_POST['comentario']) : ''; ?></textarea>
    <br><br>
    
    <!-- Novedades -->
    <input type="checkbox" id="novedades" name="novedades" <?php echo (isset($_POST['novedades'])) ? 'checked' : ''; ?>>
    <label for="novedades">Deseo recibir información sobre novedades y ofertas</label>
    <br><br>
    
    <!-- Aceptación de condiciones -->
    <input type="checkbox" id="condiciones" name="condiciones" <?php echo (isset($_POST['condiciones'])) ? 'checked' : ''; ?>>
    <label for="condiciones">Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de datos</label>
    <br><br>
    
    <!-- Botones -->
    <input type="submit" value="Enviar">
    <input type="reset" value="Limpiar">
</form>

</body>
</html>
