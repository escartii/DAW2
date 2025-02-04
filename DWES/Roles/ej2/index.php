<?php
// index.php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Identificación de Usuario</title>
</head>
<body>
  <h1>Formulario de Identificación</h1>
  <form action="procesar.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required><br><br>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" required><br><br>

    <label for="asignatura">Asignatura:</label>
    <input type="text" name="asignatura" id="asignatura" required><br><br>

    <label for="grupo">Grupo:</label>
    <input type="text" name="grupo" id="grupo" required><br><br>

    <p>¿Es mayor o menor de edad?</p>
    <input type="radio" id="mayor" name="edad" value="mayor" required>
    <label for="mayor">Mayor de edad</label><br>
    <input type="radio" id="menor" name="edad" value="menor">
    <label for="menor">Menor de edad</label><br><br>

    <p>¿Tiene cargo?</p>
    <input type="radio" id="cargo_si" name="cargo" value="si" required>
    <label for="cargo_si">Con cargo</label><br>
    <input type="radio" id="cargo_no" name="cargo" value="no">
    <label for="cargo_no">Sin cargo</label><br><br>

    <input type="submit" value="Enviar">
  </form>
</body>
</html>
