<?php
/**
 * @Author: Álvaro Escartí
 */

// Iniciar la sesión para manejar posibles mensajes persistentes (opcional)
session_start();

$mensajes = []; // Array para almacenar mensajes de error o resultados

// Inicializar variables para preservar los datos ingresados
$nombre = $apellidos = $sexo = $email = $provincia = '';
$novedades = '';
$condiciones = '';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las entradas del usuario
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
    $apellidos = isset($_POST["apellidos"]) ? trim($_POST["apellidos"]) : '';
    $sexo = isset($_POST["sexo"]) ? trim($_POST["sexo"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : '';
    $novedades = isset($_POST["novedades"]) ? 'Sí' : 'No';
    $condiciones = isset($_POST["condiciones"]) ? 'Sí' : 'No';

    // Validaciones

    // Validar el campo 'nombre'
    if (empty($nombre)) {
        $mensajes[] = "El campo 'Nombre' es obligatorio.";
    } elseif (strlen($nombre) > 50) {
        $mensajes[] = "El campo 'Nombre' no puede exceder los 50 caracteres.";
    }

    // Validar el campo 'apellidos'
    if (empty($apellidos)) {
        $mensajes[] = "El campo 'Apellidos' es obligatorio.";
    } elseif (strlen($apellidos) > 200) {
        $mensajes[] = "El campo 'Apellidos' no puede exceder los 200 caracteres.";
    }

    // Validar el campo 'sexo'
    $opcionesSexo = ["Hombre", "Mujer"];
    if (empty($sexo)) {
        $mensajes[] = "Debe seleccionar un género.";
    } elseif (!in_array($sexo, $opcionesSexo)) {
        $mensajes[] = "La opción de género seleccionada no es válida.";
    }

    // Validar el campo 'email'
    if (empty($email)) {
        $mensajes[] = "El campo 'Correo electrónico' es obligatorio.";
    } elseif (strlen($email) > 250) {
        $mensajes[] = "El campo 'Correo electrónico' no puede exceder los 250 caracteres.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensajes[] = "El correo electrónico ingresado no es válido.";
    }

    // Validar el campo 'provincia'
    $opcionesProvincia = ["Alicante", "Castellón", "Valencia"];
    if (empty($provincia)) {
        $mensajes[] = "Debe seleccionar una provincia.";
    } elseif (!in_array($provincia, $opcionesProvincia)) {
        $mensajes[] = "La provincia seleccionada no es válida.";
    }

    // Validar el campo 'condiciones'
    if ($condiciones !== 'Sí') {
        $mensajes[] = "Debe aceptar las condiciones generales del programa y la normativa sobre protección de datos.";
    }

    // Si no hay errores, procesar los datos
    if (empty($mensajes)) {
        // Aquí puedes procesar los datos, como almacenarlos en una base de datos o enviarlos por correo

        // Por ejemplo, mostrar los datos ingresados:
        $mensajes[] = "Registro exitoso. A continuación, tus datos ingresados:";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álvaro Escartí - Formulario de Registro</title>
</head>
<body>
    <h1>Álvaro Escartí - Formulario de Registro</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($mensajes) === false && in_array("Registro exitoso. A continuación, tus datos ingresados:", $mensajes)): ?>
        <h2>Datos Ingresados:</h2>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
        <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($apellidos); ?></p>
        <p><strong>Sexo:</strong> <?php echo htmlspecialchars($sexo); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Provincia:</strong> <?php echo htmlspecialchars($provincia); ?></p>
        <p><strong>Deseo recibir información sobre novedades y ofertas:</strong> <?php echo htmlspecialchars($novedades); ?></p>
        <p><strong>Acepto las condiciones generales y la normativa de protección de datos:</strong> <?php echo htmlspecialchars($condiciones); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <!-- Campo de nombre -->
        <label for="nombre">Nombre (máximo 50 caracteres):</label>
        <input type="text" id="nombre" name="nombre" maxlength="50" value="<?php echo htmlspecialchars($nombre); ?>">
        <br><br>

        <!-- Campo de apellidos -->
        <label for="apellidos">Apellidos (máximo 200 caracteres):</label>
        <input type="text" id="apellidos" name="apellidos" maxlength="200" value="<?php echo htmlspecialchars($apellidos); ?>">
        <br><br>

        <!-- Selección de sexo -->
        <label>Sexo:</label>
        <input type="radio" id="hombre" name="sexo" value="Hombre" <?php echo ($sexo === 'Hombre') ? 'checked' : ''; ?>>
        <label for="hombre">Hombre</label>
        <input type="radio" id="mujer" name="sexo" value="Mujer" <?php echo ($sexo === 'Mujer') ? 'checked' : ''; ?>>
        <label for="mujer">Mujer</label>
        <br><br>

        <!-- Correo electrónico -->
        <label for="email">Correo electrónico (máximo 250 caracteres):</label>
        <input type="email" id="email" name="email" maxlength="250" value="<?php echo htmlspecialchars($email); ?>">
        <br><br>

        <!-- Selección de provincia -->
        <label for="provincia">Provincia:</label>
        <select id="provincia" name="provincia">
            <option value="">--Selecciona una provincia--</option>
            <?php foreach ($opcionesProvincia as $prov): ?>
                <option value="<?php echo $prov; ?>" <?php echo ($provincia === $prov) ? 'selected' : ''; ?>><?php echo $prov; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <!-- Casillas de verificación -->
        <input type="checkbox" id="novedades" name="novedades" <?php echo ($novedades === 'Sí') ? 'checked' : ''; ?>>
        <label for="novedades">Deseo recibir información sobre novedades y ofertas.</label>
        <br><br>

        <input type="checkbox" id="condiciones" name="condiciones" <?php echo ($condiciones === 'Sí') ? 'checked' : ''; ?>>
        <label for="condiciones">Declaro haber leído y aceptar las condiciones generales del programa y la normativa sobre protección de datos.</label>
        <br><br>

        <!-- Botón de envío -->
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
