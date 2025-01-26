<?php
$nombre       = $_GET['nombre'] ?? null;
$pass         = $_GET['pass'] ?? null;
$nivel        = $_GET['nivel'] ?? null;
$nacionalidad = $_GET['nacionalidad'] ?? null;
$email        = $_GET['email'] ?? null;
$idiomas      = $_GET['idiomas'] ?? null;
$foto         = $_GET['foto'] ?? null;

// Convertir la cadena de idiomas en array
$listaIdiomas = ($idiomas !== "") ? explode(",", $idiomas) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <style>
        ul { list-style-type: none; }
        li { margin-bottom: 5px; }
        img { margin-top: 10px; max-width: 200px; }
    </style>
</head>
<body>
<h1>Resultado del formulario</h1>
<p>Los datos procesados son:</p>
<ul>
    <li><b>Nombre:</b> <?php echo htmlspecialchars($nombre); ?></li>
    <li><b>Contraseña:</b> <?php echo htmlspecialchars($pass); ?></li>
    <li><b>Nivel de estudios:</b> <?php echo htmlspecialchars($nivel); ?></li>
    <li><b>Nacionalidad:</b> <?php echo htmlspecialchars($nacionalidad); ?></li>
    <li><b>Email:</b> <?php echo htmlspecialchars($email); ?></li>
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
    <li><b>Foto:</b>
        <?php
        if (!empty($foto) && file_exists($foto)) {
            echo "<br><img src='" . htmlspecialchars($foto) . "' alt='Foto'>";
        } else {
            echo " (No se encontró la foto)";
        }
        ?>
    </li>
</ul>
</body>
</html>
