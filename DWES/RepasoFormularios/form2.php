<?php
// Obtenemos las variables que vienen por la URL (GET)
$nombre    = $_GET['nombre'] ?? null;
$email     = $_GET['correo'] ?? null;  // En el formulario usaste 'correo'
$situacion = $_GET['situacion'] ?? ""; // Esto llegará como string con comas
$idiomas   = $_GET['idiomas']   ?? ""; // Esto también llegará como string con comas

// Convertir la cadena de situación en array
$listaSituacion = ($situacion !== "") ? explode(",", $situacion) : [];

// Convertir la cadena de idiomas en array
$listaIdiomas = ($idiomas !== "") ? explode(",", $idiomas) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado2</title>
    <style>
        ul { list-style-type: none; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>
<h1>Resultado del formulario</h1>
<p>Estos son los datos procesados:</p>
<ul>
    <li><b>Nombre:</b> <?php echo htmlspecialchars($nombre); ?></li>
    <li><b>Correo:</b> <?php echo htmlspecialchars($email); ?></li>
    <li><b>Situación:</b>
        <?php
        if (empty($listaSituacion)) {
            echo "(Ninguna situación seleccionada)";
        } else {
            echo "<ul>";
            foreach ($listaSituacion as $sit) {
                echo "<li>" . htmlspecialchars($sit) . "</li>";
            }
            echo "</ul>";
        }
        ?>
    </li>
    <li><b>Idiomas:</b>
        <?php
        if (empty($listaIdiomas)) {
            echo "(Ningún idioma seleccionado)";
        } else {
            echo "<ul>";
            foreach ($listaIdiomas as $idioma) {
                echo "<li>" . htmlspecialchars($idioma) . "</li>";
            }
            echo "</ul>";
        }
        ?>
    </li>
</ul>
</body>
</html>
