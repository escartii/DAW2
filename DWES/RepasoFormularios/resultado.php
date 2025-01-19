<?php
$nombre       = $_GET['nombre'] ?? "";
$pass         = $_GET['pass'] ?? "";
$nivel        = $_GET['nivel'] ?? "";
$nacionalidad = $_GET['nacionalidad'] ?? "";
$email        = $_GET['email'] ?? "";
$idiomas      = $_GET['idiomas'] ?? "";
$foto         = $_GET['foto'] ?? "";

// Convertimos la cadena de idiomas en array
$listaIdiomas = explode(",", $idiomas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
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
        // Si no seleccionaron nada, la cadena será "", lo cual explode da array(1) con ""
        // Puedes controlar eso para no mostrar un item vacío:
        if ($idiomas == "") {
            echo "(Ningún idioma seleccionado)";
        } else {
            echo "<ul>";
            foreach($listaIdiomas as $i){
                echo "<li>".htmlspecialchars($i)."</li>";
            }
            echo "</ul>";
        }
        ?>
    </li>
    <li><b>Ruta de la foto:</b> <?php echo htmlspecialchars($foto); ?></li>
    <li>
        <?php
        if (!empty($foto) && file_exists($foto)) {
            echo "<img src='$foto' alt='Foto' width='200'>";
        } else {
            echo "(No se encontró la foto)";
        }
        ?>
    </li>
</ul>
</body>
</html>
