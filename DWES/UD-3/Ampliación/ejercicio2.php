<?php

/**
* @Author: Álvaro Escartí
*/


$nota = readline("Escribe la nota del alumno 'X': ");

if ($nota <= 4){
    echo "Alumno 'X' ha suspendido.\n";
} else if ($nota >= 5 && $nota <= 10) {
    echo "Alumno 'X' ha aprobado.\n"; 
} else {
    echo "La nota no es válida.\n";
}


?>