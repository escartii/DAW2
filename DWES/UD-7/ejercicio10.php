<?php
session_start();

/**
 * @Author: Álvaro Escartí
 */

// Definir el array asociativo de trabajadores con sus salarios
$trabajadores = [
    "Alvaro" => 3000,
    "Marc" => 3000,
    "Javi" => 999,
    "Jorge" => 1800,
    "Antonio" => 5300
];

// Función para calcular el salario máximo
function salarioMaximo($trabajadores) {
    return max($trabajadores);
}

// Función para calcular el salario mínimo
function salarioMinimo($trabajadores) {
    return min($trabajadores);
}

// Función para calcular el salario medio
function salarioMedio($trabajadores) {
    return array_sum($trabajadores) / count($trabajadores);
}

$mensajes = []; // Array para almacenar mensajes de error o resultados
$resultado = ''; // Variable para almacenar el resultado de la operación

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar la entrada del usuario
    $accion = isset($_POST["accion"]) ? trim($_POST["accion"]) : '';
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
    $publicidad = isset($_POST["publicidad"]) ? trim($_POST["publicidad"]) : '';

    // Validar que 'accion' no esté vacío
    if ($accion === '') {
        $mensajes[] = "Debe seleccionar una acción para calcular.";
    } else {
        // Verificar que 'accion' sea una opción válida
        $opcionesValidas = ["maximo", "minimo", "medio"];
        if (!in_array($accion, $opcionesValidas)) {
            $mensajes[] = "La acción seleccionada no es válida.";
        } else {
            // Realizar la operación correspondiente
            switch ($accion) {
                case "maximo":
                    $maximo = salarioMaximo($trabajadores);
                    $resultado = "El salario máximo es: €" . htmlspecialchars($maximo) . ".";
                    break;
                case "minimo":
                    $minimo = salarioMinimo($trabajadores);
                    $resultado = "El salario mínimo es: €" . htmlspecialchars($minimo) . ".";
                    break;
                case "medio":
                    $medio = salarioMedio($trabajadores);
                    $resultado = "El salario medio es: €" . number_format($medio, 2) . ".";
                    break;
                default:
                    // Esta opción nunca debería ocurrir debido a la validación anterior
                    $mensajes[] = "Ocurrió un error desconocido.";
                    break;
            }

            // Si se ha calculado un resultado, añadirlo al array de mensajes
            if ($resultado !== '') {
                $mensajes[] = $resultado;
            }

            // Guardar la selección actual en la sesión
            $_SESSION['actual'] = [
                'nombre' => $nombre,
                'publicidad' => $publicidad
            ];

            // Guardar la selección anterior en la sesión
            if (isset($_SESSION['actual'])) {
                $_SESSION['anterior'] = $_SESSION['actual'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salarios de Trabajadores</title>
</head>
<body>
    <h1>Calculadora de Salarios de Trabajadores</h1>

    <?php if (!empty($mensajes)): ?>
        <div>
            <?php foreach ($mensajes as $mensaje): ?>
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
        <br><br>
        <label for="publicidad">¿Desea recibir publicidad?</label>
        <select name="publicidad" id="publicidad">
            <option value="si" <?php echo (isset($_POST['publicidad']) && $_POST['publicidad'] === 'si') ? 'selected' : ''; ?>>Sí</option>
            <option value="no" <?php echo (isset($_POST['publicidad']) && $_POST['publicidad'] === 'no') ? 'selected' : ''; ?>>No</option>
        </select>
        <br><br>
        <label for="accion">Selecciona qué cálculo deseas realizar:</label>
        <select name="accion" id="accion">
            <option value="">--Selecciona una acción--</option>
            <option value="maximo" <?php echo (isset($_POST['accion']) && $_POST['accion'] === 'maximo') ? 'selected' : ''; ?>>Salario Máximo</option>
            <option value="minimo" <?php echo (isset($_POST['accion']) && $_POST['accion'] === 'minimo') ? 'selected' : ''; ?>>Salario Mínimo</option>
            <option value="medio" <?php echo (isset($_POST['accion']) && $_POST['accion'] === 'medio') ? 'selected' : ''; ?>>Salario Medio</option>
        </select>
        <br><br>
        <input type="submit" value="Calcular">
    </form>

    <?php if (isset($_SESSION['actual'])): ?>
        <h2>Usuario Actual</h2>
        <p>Nombre: <?php echo htmlspecialchars($_SESSION['actual']['nombre']); ?></p>
        <p>Publicidad: <?php echo htmlspecialchars($_SESSION['actual']['publicidad']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['anterior'])): ?>
        <h2>Usuario Anterior</h2>
        <p>Nombre: <?php echo htmlspecialchars($_SESSION['anterior']['nombre']); ?></p>
        <p>Publicidad: <?php echo htmlspecialchars($_SESSION['anterior']['publicidad']); ?></p>
    <?php endif; ?>
</body>
</html>