<?php

/**
 * @Author: Álvaro Escartí
 */

 $nombre       = $_GET['nombre'] ?? null;
 $pass         = $_GET['pass'] ?? null;
 $usuario      = $_GET['usuario'] ?? null;
 $poblacion    = $_GET['poblacion'] ?? null;
 $email        = $_GET['email'] ?? null;
 $elementosAfectados      = $_GET['elementosAfectados'] ?? [];
 $necesidades      = $_GET['necesidades'] ?? [];
 $foto         = $_GET['foto'] ?? null;
 
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
 <h1 style="color: blue">Sus datos han sido validados correctamente</h1>
 <p>Los datos procesados son:</p>
 <ul>
    
     <li><b><strong>Nombre:</b> <?php echo strtoupper($nombre); ?></strong></li>
     <li><b><strong>Contraseña:</b> <?php echo strtoupper($pass); ?></strong></li>
     <li><b><strong>Nombre de usuario</b> <?php echo strtoupper($usuario); ?></strong></li>
     <li><b><strong>poblacion</b> <?php echo strtoupper($poblacion); ?></strong></li>
     <li><b><strong>Email:</b> <?php echo strtoupper($email); ?></strong></li>
     <li><b><strong>Elementos Afectados :</b> <?php echo strtoupper($elementosAfectados); ?></strong></li>
     <li><b><strong>necesidades :</b> <?php echo strtoupper($necesidades); ?></strong></li>
         <?php
         if (empty($elementosAfectados)) {
            echo "(Ningún elemento seleccionado)";
        } else {
            echo "<ul>";
            foreach ($elementosAfectados as $afectados) {
                echo "<li>" . htmlspecialchars($afectados) . "</li>";
            }
            echo "</ul>";
        }

        if (empty($necesidades)) {
            echo "(Ningún elemento seleccionado)";
        } else {
            echo "<ul>";
            foreach ($necesidades as $necesidad) {
                echo "<li>" . htmlspecialchars($necesidad) . "</li>";
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