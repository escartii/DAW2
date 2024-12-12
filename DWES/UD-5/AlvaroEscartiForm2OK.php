<?php
/**
 * @Author: Álvaro Escartí
 */

session_start();

$mensajes = []; // Array para almacenar mensajes de error o resultados

// Definir las opciones válidas para ciertos campos
$opcionesSexo = ["hombre", "mujer"];
$opcionesProvincia = ["Alicante", "Castellón", "Valencia"];
$opcionesSituacion = ["Estudiando", "Trabajando", "Buscando empleo", "Otro"];

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar las entradas del usuario
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
    $apellidos = isset($_POST["apellidos"]) ? trim($_POST["apellidos"]) : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : '';
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : '';
    $sexo = isset($_POST["sexo"]) ? trim($_POST["sexo"]) : '';
    $provincia = isset($_POST["provincia"]) ? trim($_POST["provincia"]) : '';
    $situacion = isset($_POST["situacion"]) ? $_POST["situacion"] : [];
    $novedades = isset($_POST["novedades"]) ? 'Sí' : 'No';
    $condiciones = isset($_POST["condiciones"]) ? 'Sí' : 'No';
    $comentario = isset($_POST["comentario"]) ? trim($_POST["comentario"]) : '';
    
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
    
    // Validar el campo 'email'
    if (empty($email)) {
        $mensajes[] = "El campo 'Correo electrónico' es obligatorio.";
    } elseif (strlen($email) > 250) {
        $mensajes[] = "El campo 'Correo electrónico' no puede exceder los 250 caracteres.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensajes[] = "El correo electrónico ingresado no es válido.";
    }
    
    // Validar el campo 'usuario'
    if (empty($usuario)) {
        $mensajes[] = "El campo 'Usuario' es obligatorio.";
    } elseif (strlen($usuario) > 5) {
        $mensajes[] = "El campo 'Usuario' no puede exceder los 5 caracteres.";
    }
    
    // Validar el campo 'password'
    if (empty($password)) {
        $mensajes[] = "El campo 'Password' es obligatorio.";
    } elseif (strlen($password) > 15) {
        $mensajes[] = "El campo 'Password' no puede exceder los 15 caracteres.";
    }
    
    // Validar el campo 'sexo'
    if (empty($sexo)) {
        $mensajes[] = "Debe seleccionar un género.";
    } elseif (!in_array($sexo, $opcionesSexo)) {
        $mensajes[] = "La opción de género seleccionada no es válida.";
    }
    
    // Validar el campo 'provincia'
    if (empty($provincia)) {
        $mensajes[] = "Debe seleccionar una provincia.";
    } elseif (!in_array($provincia, $opcionesProvincia)) {
        $mensajes[] = "La provincia seleccionada no es válida.";
    }
    
    // Validar el campo 'situacion'
    if (empty($situacion)) {
        $mensajes[] = "Debe seleccionar al menos una situación.";
    } else {
        foreach ($situacion as $sit) {
            if (!in_array($sit, $opcionesSituacion)) {
                $mensajes[] = "La situación '$sit' no es válida.";
                break;
            }
        }
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
        // Almacenar los datos en una sesión para mostrarlos en el formulario
        $_SESSION['registro_exitoso'] = true;
        $_SESSION['datos_registro'] = [
            'Nombre' => $nombre,
            'Apellidos' => $apellidos,
            'Correo Electrónico' => $email,
            'Usuario' => $usuario,
            'Password' => str_repeat('*', strlen($password)), // Mostrar asteriscos en lugar de la contraseña real
            'Sexo' => ucfirst($sexo),
            'Provincia' => $provincia,
            'Situación' => implode(', ', $situacion),
            'Deseo recibir información sobre novedades y ofertas' => $novedades,
            'Acepto las condiciones generales y la normativa de protección de datos' => $condiciones,
            'Comentario' => htmlspecialchars($comentario)
        ];
    }
}
?>

<?php
// Mostrar mensajes y datos si el registro fue exitoso
if (!empty($mensajes)) {
    echo '<div>';
    foreach ($mensajes as $mensaje) {
        echo '<p>' . htmlspecialchars($mensaje) . '</p>';
    }
    echo '</div>';
    
    if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso'] === true) {
        echo '<h2>Datos Ingresados:</h2>';
        echo '<ul>';
        foreach ($_SESSION['datos_registro'] as $campo => $valor) {
            echo '<li><strong>' . htmlspecialchars($campo) . ':</strong> ' . htmlspecialchars($valor) . '</li>';
        }
        echo '</ul>';
        // Limpiar los datos de la sesión después de mostrarlos
        session_unset();
    }
}
?>
