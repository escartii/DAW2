<?php

/**
 * @Author: Álvaro Escartí
 */

$alumnosClase = readline("Dime todos los alumnos: ");
$superanMedia = 0;
$notaMedia = 0;

for ($i=1; $i <= $alumnosClase; $i++) { 
    $notasAlumnos = readline("Introduce la nota del " .$i . " alumno: ");
    $notaMedia += $notasAlumnos;
}

$notaMedia /= $alumnosClase;





echo "Nota media de los alumnos: " . $notaMedia . "\n";


?>
