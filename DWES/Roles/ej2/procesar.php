<?php
// procesar.php
session_start();

// Recoger datos del formulario
$nombre     = isset($_POST['nombre']) ? trim($_POST['nombre']) : "";
$apellido   = isset($_POST['apellido']) ? trim($_POST['apellido']) : "";
$asignatura = isset($_POST['asignatura']) ? trim($_POST['asignatura']) : "";
$grupo      = isset($_POST['grupo']) ? trim($_POST['grupo']) : "";
$edad       = isset($_POST['edad']) ? $_POST['edad'] : "";
$cargo      = isset($_POST['cargo']) ? $_POST['cargo'] : "";

// Validamos que los datos obligatorios se hayan enviado (podrías hacer más validaciones)
if ($nombre === "" || $apellido === "" || $asignatura === "" || $grupo === "" || $edad === "" || $cargo === "") {
    echo "Faltan datos. Por favor vuelve al formulario.";
    exit;
}

// Guardamos la información del usuario en la sesión
$_SESSION['usuario'] = [
    'nombre'     => $nombre,
    'apellido'   => $apellido,
    'asignatura' => $asignatura,
    'grupo'      => $grupo,
    'edad'       => $edad,   // "mayor" o "menor"
    'cargo'      => $cargo   // "si" o "no"
];

// Clasificación según la lógica:
// - Si es menor de edad:
//      Con cargo → Delegado
//      Sin cargo  → Estudiante
// - Si es mayor de edad:
//      Con cargo → Director
//      Sin cargo  → Profesor
if ($edad === "menor") {
    if ($cargo === "si") {
        $perfil = "delegado";
    } else { // cargo == "no"
        $perfil = "estudiante";
    }
} else { // edad === "mayor"
    if ($cargo === "si") {
        $perfil = "director";
    } else { // cargo == "no"
        $perfil = "profesor";
    }
}

// Redirigimos a la página del perfil correspondiente
header("Location: {$perfil}.php");
exit;
