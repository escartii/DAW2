<?php
session_start();

// Si no existe aún el token de formulario en la sesión, se genera uno
if (!isset($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}

$errores = [];
$mensaje_token = '';  // Para avisos relacionados con el token

// Definimos los valores iniciales para los campos del formulario, incluyendo el rol
$valores = [
    'nombre'      => '',
    'edad'        => '',
    'rol'         => '',
    'nivel'       => '',
    'situacion'   => [],
    'hobbies'     => [],
    'otro_hobby'  => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Si se pulsa el botón "Cambiar SID", se genera un nuevo token
    if (isset($_POST['cambiar_sid'])) {
         $_SESSION['form_token'] = bin2hex(random_bytes(32));
         $mensaje_token = "Token de formulario cambiado. Si envías el formulario con el token antiguo se mostrará un error.";
    } else {
         // Comprobar que el token enviado coincide con el almacenado en la sesión
         if (!isset($_POST['form_token']) || $_POST['form_token'] !== $_SESSION['form_token']) {
             $errores['token'] = 'El token del formulario no coincide. La sesión puede haber sido alterada.';
         }

         // Recoger los datos enviados y sanitizarlos
         $valores['nombre']      = trim($_POST['nombre']);
         $valores['edad']        = trim($_POST['edad']);
         $valores['rol']         = $_POST['rol'] ?? '';
         $valores['nivel']       = $_POST['nivel'] ?? '';
         $valores['situacion']   = $_POST['situacion'] ?? [];
         $valores['hobbies']     = $_POST['hobbies'] ?? [];
         $valores['otro_hobby']  = trim($_POST['otro_hobby']);

         // Validación de cada campo
         if (empty($valores['nombre'])) {
             $errores['nombre'] = 'El nombre es obligatorio.';
         }
         if (!is_numeric($valores['edad']) || $valores['edad'] <= 0) {
             $errores['edad'] = 'La edad debe ser un número positivo.';
         }
         if (empty($valores['rol'])) {
             $errores['rol'] = 'Debe seleccionar un rol.';
         }
         if (empty($valores['nivel'])) {
             $errores['nivel'] = 'Debe seleccionar un nivel de estudios.';
         }
         if (empty($valores['situacion'])) {
             $errores['situacion'] = 'Debe seleccionar al menos una situación.';
         }

         // Si no hay errores, se guardan los datos en la sesión y se redirige a la página de resultados
         if (empty($errores)) {
             $_SESSION['datos'] = $valores;
             header('Location: ejercicio2-resultado.php');
             exit;
         }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Datos - Roles</title>
</head>
<body>
    <h1>Recogida de Datos Personales y Roles</h1>
    
    <!-- Avisos sobre el token o error de validación de token -->
    <?php if (!empty($mensaje_token)): ?>
       <p style="color: blue;"><?= htmlspecialchars($mensaje_token) ?></p>
    <?php endif; ?>
    <?php if (!empty($errores['token'])): ?>
       <p style="color: red;"><?= htmlspecialchars($errores['token']) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <!-- Campo oculto para el token -->
        <input type="hidden" name="form_token" value="<?= htmlspecialchars($_SESSION['form_token']) ?>">

        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($valores['nombre']) ?>">
        <span style="color: red;"><?= $errores['nombre'] ?? '' ?></span>
        <br><br>

        <!-- Edad -->
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" value="<?= htmlspecialchars($valores['edad']) ?>">
        <span style="color: red;"><?= $errores['edad'] ?? '' ?></span>
        <br><br>

        <!-- Rol -->
        <label for="rol">Rol:</label>
        <select name="rol" id="rol">
            <option value="">Seleccione...</option>
            <option value="delegado" <?= $valores['rol'] == 'delegado' ? 'selected' : '' ?>>Delegado</option>
            <option value="estudiante" <?= $valores['rol'] == 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
            <option value="profesor" <?= $valores['rol'] == 'profesor' ? 'selected' : '' ?>>Profesor</option>
            <option value="director" <?= $valores['rol'] == 'director' ? 'selected' : '' ?>>Director</option>
        </select>
        <span style="color: red;"><?= $errores['rol'] ?? '' ?></span>
        <br><br>

        <!-- Nivel de estudios -->
        <label for="nivel">Nivel de estudios:</label>
        <select name="nivel" id="nivel">
            <option value="">Seleccione...</option>
            <option value="primaria" <?= $valores['nivel'] == 'primaria' ? 'selected' : '' ?>>Primaria</option>
            <option value="secundaria" <?= $valores['nivel'] == 'secundaria' ? 'selected' : '' ?>>Secundaria</option>
            <option value="universidad" <?= $valores['nivel'] == 'universidad' ? 'selected' : '' ?>>Universidad</option>
        </select>
        <span style="color: red;"><?= $errores['nivel'] ?? '' ?></span>
        <br><br>

        <!-- Situación actual -->
        <label>Situación actual:</label><br>
        <label><input type="checkbox" name="situacion[]" value="estudiando" <?= in_array('estudiando', $valores['situacion']) ? 'checked' : '' ?>> Estudiando</label><br>
        <label><input type="checkbox" name="situacion[]" value="trabajando" <?= in_array('trabajando', $valores['situacion']) ? 'checked' : '' ?>> Trabajando</label><br>
        <label><input type="checkbox" name="situacion[]" value="buscando empleo" <?= in_array('buscando empleo', $valores['situacion']) ? 'checked' : '' ?>> Buscando empleo</label><br>
        <label><input type="checkbox" name="situacion[]" value="desempleado" <?= in_array('desempleado', $valores['situacion']) ? 'checked' : '' ?>> Desempleado</label><br>
        <span style="color: red;"><?= $errores['situacion'] ?? '' ?></span>
        <br><br>

        <!-- Hobbies -->
        <label>Hobbies:</label><br>
        <label><input type="checkbox" name="hobbies[]" value="leer" <?= in_array('leer', $valores['hobbies']) ? 'checked' : '' ?>> Leer</label><br>
        <label><input type="checkbox" name="hobbies[]" value="deportes" <?= in_array('deportes', $valores['hobbies']) ? 'checked' : '' ?>> Deportes</label><br>
        <label><input type="checkbox" name="hobbies[]" value="música" <?= in_array('música', $valores['hobbies']) ? 'checked' : '' ?>> Música</label><br>
        <label for="otro_hobby">Otro:</label>
        <input type="text" name="otro_hobby" id="otro_hobby" value="<?= htmlspecialchars($valores['otro_hobby']) ?>">
        <br><br>

        <!-- Botones -->
        <button type="submit" name="submit">Enviar</button>
        <button type="submit" name="cambiar_sid" value="1">Cambiar SID</button>
    </form>
</body>
</html>
<?php
session_start();

// Si no existe aún el token de formulario en la sesión, se genera uno
if (!isset($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}

$errores = [];
$mensaje_token = '';  // Para avisos relacionados con el token

// Definimos los valores iniciales para los campos del formulario, incluyendo el rol
$valores = [
    'nombre'      => '',
    'edad'        => '',
    'rol'         => '',
    'nivel'       => '',
    'situacion'   => [],
    'hobbies'     => [],
    'otro_hobby'  => '',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Si se pulsa el botón "Cambiar SID", se genera un nuevo token
    if (isset($_POST['cambiar_sid'])) {
         $_SESSION['form_token'] = bin2hex(random_bytes(32));
         $mensaje_token = "Token de formulario cambiado. Si envías el formulario con el token antiguo se mostrará un error.";
    } else {
         // Comprobar que el token enviado coincide con el almacenado en la sesión
         if (!isset($_POST['form_token']) || $_POST['form_token'] !== $_SESSION['form_token']) {
             $errores['token'] = 'El token del formulario no coincide. La sesión puede haber sido alterada.';
         }

         // Recoger los datos enviados y sanitizarlos
         $valores['nombre']      = trim($_POST['nombre']);
         $valores['edad']        = trim($_POST['edad']);
         $valores['rol']         = $_POST['rol'] ?? '';
         $valores['nivel']       = $_POST['nivel'] ?? '';
         $valores['situacion']   = $_POST['situacion'] ?? [];
         $valores['hobbies']     = $_POST['hobbies'] ?? [];
         $valores['otro_hobby']  = trim($_POST['otro_hobby']);

         // Validación de cada campo
         if (empty($valores['nombre'])) {
             $errores['nombre'] = 'El nombre es obligatorio.';
         }
         if (!is_numeric($valores['edad']) || $valores['edad'] <= 0) {
             $errores['edad'] = 'La edad debe ser un número positivo.';
         }
         if (empty($valores['rol'])) {
             $errores['rol'] = 'Debe seleccionar un rol.';
         }
         if (empty($valores['nivel'])) {
             $errores['nivel'] = 'Debe seleccionar un nivel de estudios.';
         }
         if (empty($valores['situacion'])) {
             $errores['situacion'] = 'Debe seleccionar al menos una situación.';
         }

         // Si no hay errores, se guardan los datos en la sesión y se redirige a la página de resultados
         if (empty($errores)) {
             $_SESSION['datos'] = $valores;
             header('Location: ejercicio2-resultado.php');
             exit;
         }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Datos - Roles</title>
</head>
<body>
    <h1>Recogida de Datos Personales y Roles</h1>
    
    <!-- Avisos sobre el token o error de validación de token -->
    <?php if (!empty($mensaje_token)): ?>
       <p style="color: blue;"><?= htmlspecialchars($mensaje_token) ?></p>
    <?php endif; ?>
    <?php if (!empty($errores['token'])): ?>
       <p style="color: red;"><?= htmlspecialchars($errores['token']) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <!-- Campo oculto para el token -->
        <input type="hidden" name="form_token" value="<?= htmlspecialchars($_SESSION['form_token']) ?>">

        <!-- Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($valores['nombre']) ?>">
        <span style="color: red;"><?= $errores['nombre'] ?? '' ?></span>
        <br><br>

        <!-- Edad -->
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" value="<?= htmlspecialchars($valores['edad']) ?>">
        <span style="color: red;"><?= $errores['edad'] ?? '' ?></span>
        <br><br>

        <!-- Rol -->
        <label for="rol">Rol:</label>
        <select name="rol" id="rol">
            <option value="">Seleccione...</option>
            <option value="delegado" <?= $valores['rol'] == 'delegado' ? 'selected' : '' ?>>Delegado</option>
            <option value="estudiante" <?= $valores['rol'] == 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
            <option value="profesor" <?= $valores['rol'] == 'profesor' ? 'selected' : '' ?>>Profesor</option>
            <option value="director" <?= $valores['rol'] == 'director' ? 'selected' : '' ?>>Director</option>
        </select>
        <span style="color: red;"><?= $errores['rol'] ?? '' ?></span>
        <br><br>

        <!-- Nivel de estudios -->
        <label for="nivel">Nivel de estudios:</label>
        <select name="nivel" id="nivel">
            <option value="">Seleccione...</option>
            <option value="primaria" <?= $valores['nivel'] == 'primaria' ? 'selected' : '' ?>>Primaria</option>
            <option value="secundaria" <?= $valores['nivel'] == 'secundaria' ? 'selected' : '' ?>>Secundaria</option>
            <option value="universidad" <?= $valores['nivel'] == 'universidad' ? 'selected' : '' ?>>Universidad</option>
        </select>
        <span style="color: red;"><?= $errores['nivel'] ?? '' ?></span>
        <br><br>

        <!-- Situación actual -->
        <label>Situación actual:</label><br>
        <label><input type="checkbox" name="situacion[]" value="estudiando" <?= in_array('estudiando', $valores['situacion']) ? 'checked' : '' ?>> Estudiando</label><br>
        <label><input type="checkbox" name="situacion[]" value="trabajando" <?= in_array('trabajando', $valores['situacion']) ? 'checked' : '' ?>> Trabajando</label><br>
        <label><input type="checkbox" name="situacion[]" value="buscando empleo" <?= in_array('buscando empleo', $valores['situacion']) ? 'checked' : '' ?>> Buscando empleo</label><br>
        <label><input type="checkbox" name="situacion[]" value="desempleado" <?= in_array('desempleado', $valores['situacion']) ? 'checked' : '' ?>> Desempleado</label><br>
        <span style="color: red;"><?= $errores['situacion'] ?? '' ?></span>
        <br><br>

        <!-- Hobbies -->
        <label>Hobbies:</label><br>
        <label><input type="checkbox" name="hobbies[]" value="leer" <?= in_array('leer', $valores['hobbies']) ? 'checked' : '' ?>> Leer</label><br>
        <label><input type="checkbox" name="hobbies[]" value="deportes" <?= in_array('deportes', $valores['hobbies']) ? 'checked' : '' ?>> Deportes</label><br>
        <label><input type="checkbox" name="hobbies[]" value="música" <?= in_array('música', $valores['hobbies']) ? 'checked' : '' ?>> Música</label><br>
        <label for="otro_hobby">Otro:</label>
        <input type="text" name="otro_hobby" id="otro_hobby" value="<?= htmlspecialchars($valores['otro_hobby']) ?>">
        <br><br>

        <!-- Botones -->
        <button type="submit" name="submit">Enviar</button>
        <button type="submit" name="cambiar_sid" value="1">Cambiar SID</button>
    </form>
</body>
</html>
