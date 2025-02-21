<?php
// Iniciar la sesión para manejar mensajes de error si es necesario
session_start();

// Inicializar el array de errores
$errores = [];

// Función para limpiar entradas
function limpiarEntrada($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Validar Nombre
if (empty($_POST['nombre'])) {
    $errores[] = "El nombre es obligatorio.";
} else {
    $nombre = limpiarEntrada($_POST['nombre']);
    if (!preg_match("/^[a-zA-ZÁ-ÿ\s]+$/", $nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios.";
    }
}

// Validar Apellido
if (empty($_POST['apellido'])) {
    $errores[] = "El apellido es obligatorio.";
} else {
    $apellido = limpiarEntrada($_POST['apellido']);
    if (!preg_match("/^[a-zA-ZÁ-ÿ\s]+$/", $apellido)) {
        $errores[] = "El apellido solo puede contener letras y espacios.";
    }
}

// Validar Email
if (empty($_POST['email'])) {
    $errores[] = "El correo electrónico es obligatorio.";
} else {
    $email = limpiarEntrada($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }
}

// Validar Contraseña
if (empty($_POST['password'])) {
    $errores[] = "La contraseña es obligatoria.";
} else {
    $password = $_POST['password'];
    // Puedes agregar más validaciones de contraseña aquí
    if (strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }
}

// Validar Imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $imagen = $_FILES['imagen'];

    // Obtener detalles de la imagen
    $nombreImagen = $imagen['name'];
    $tipoImagen = $imagen['type'];
    $tamanoImagen = $imagen['size'];
    $rutaTemporal = $imagen['tmp_name'];

    // Obtener la extensión de la imagen
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));

    if (!in_array($extension, $extensionesPermitidas)) {
        $errores[] = "La imagen debe ser de tipo JPG, JPEG, PNG o GIF.";
    }

    // Verificar el tamaño de la imagen (máximo 2MB)
    if ($tamanoImagen > 2 * 1024 * 1024) {
        $errores[] = "La imagen no debe exceder los 2MB.";
    }

    // Opcional: verificar si el archivo es realmente una imagen
    $verificarImagen = getimagesize($rutaTemporal);
    if ($verificarImagen === false) {
        $errores[] = "El archivo subido no es una imagen válida.";
    }
} else {
    $errores[] = "Debe subir una imagen.";
}

// Si hay errores, redirigir de vuelta al formulario con los errores
if (!empty($errores)) {
    header("Location: formulario.html?errores=" . urlencode(serialize($errores)));
    exit();
}

// Si todo está bien, procesar los datos (por ejemplo, guardar en la base de datos)
// Aquí simplemente mostraremos un mensaje de éxito

// Mover la imagen a una carpeta en el servidor (asegúrate de que exista y tenga permisos)
$carpetaDestino = 'uploads/';
if (!is_dir($carpetaDestino)) {
    mkdir($carpetaDestino, 0755, true);
}
$nombreUnico = uniqid() . '.' . $extension;
$rutaFinal = $carpetaDestino . $nombreUnico;

if (move_uploaded_file($rutaTemporal, $rutaFinal)) {
    echo "<h2>Registro Exitoso</h2>";
    echo "<p>Nombre: $nombre</p>";
    echo "<p>Apellido: $apellido</p>";
    echo "<p>Correo Electrónico: $email</p>";
    echo "<p>Imagen Subida:</p>";
    echo "<img src='$rutaFinal' alt='Imagen de $nombre' style='max-width:300px;'>";
} else {
    echo "<p style='color: red;'>Hubo un error al subir la imagen.</p>";
}
?>
